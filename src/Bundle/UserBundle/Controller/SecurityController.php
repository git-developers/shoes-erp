<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Bundle\UserBundle\Form\Type\UserLoginType;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;
use Bundle\ProfileBundle\Entity\Profile;
use Bundle\UserBundle\Entity\User;
use Bundle\UserBundle\Entity\ResetPassword;
use Bundle\UserBundle\Entity\ChangePassword2;
use Bundle\UserBundle\Form\Type\UserRegisterType;
use Bundle\UserBundle\Form\Type\UserResetPasswordType;
use Bundle\UserBundle\Form\Type\UserChangePasswordType2;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\UserBundle\Entity\ChangePassword;
use Bundle\CoreBundle\Vendor\Facebook\Facebook;
use Bundle\CoreBundle\Vendor\Facebook\Exceptions\FacebookSDKException;
use Bundle\CoreBundle\Vendor\Facebook\Exceptions\FacebookResponseException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends BaseController
{
    /**
     * Login form action.
     */
    public function loginAction(Request $request): Response
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $form = $this->createForm(UserLoginType::class);
        $form->handleRequest($request);

        return $this->render($template,
            [
                'form' => $form->createView(),
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function loginFacebookCallbackAction(Request $request): Response
    {

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $fb = new Facebook([
            'app_id' => $this->container->getParameter('application_fb_app_id'),
            'app_secret' => $this->container->getParameter('application_fb_app_secret'),
            'default_graph_version' => 'v2.2', // v3.0
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);

        // Validation (these will throw FacebookSDKException's when they fail)
                $tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request): Response
    {

//        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
//        {
//            return $this->redirect($this->generateUrl('backend_dashboard_index'));
//        }

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $entity = new User();
        $form = $this->createForm(UserRegisterType::class, $entity, [
            'application_url' => $this->container->getParameter('application_url')
        ]);

        $form->handleRequest($request);

        $validator = $this->container->get('validator');
        $validator->validate($entity, null, ['registration']);

        $profile = $this->get('tianos.repository.profile')->findOneBySlug(Profile::REGULAR_USER_SLUG);
        $entity->setProfile($profile);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persist($entity);

//            $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');

            $this->flashSuccess('Cuenta creada, puedes iniciar sesión.');

            return $this->redirectToRoute('backend_security_login_admin');
        }

        /**
         * Facebook
         */
        $fb = new Facebook([
            'app_id' => $this->container->getParameter('application_fb_app_id'),
            'app_secret' => $this->container->getParameter('application_fb_app_secret'),
            'default_graph_version' => 'v2.2', // v3.0
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $redirectUrl = $this->generateUrl('backend_security_login_facebook_callback');
        $redirectUrl = 'https://tianos.com/backend/security/login-facebook-callback';
        $loginUrl = $helper->getLoginUrl($redirectUrl, $permissions);
        /**
         * Facebook
         */

        return $this->render($template, [
            'form' => $form->createView(),
            'loginUrl' => htmlspecialchars($loginUrl),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function resetPasswordStepOneAction(Request $request): Response
    {

//        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
//        {
//            return $this->redirect($this->generateUrl('backend_dashboard_index'));
//        }

//        https://myaccount.google.com/lesssecureapps

        $email = $request->get('email');
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $entity = new ResetPassword();
        $form = $this->createForm(UserResetPasswordType::class, $entity, [
            'application_url' => $this->container->getParameter('application_url')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('tianos.repository.user')->findOneByEmail2($entity->getEmail());

            if (is_null($user)) {
                $this->flashWarning('Usuario con email: ' . $entity->getEmail() . ' , no existe.');
                return $this->redirectToRoute('backend_security_reset_password_step_one', ['email' => $entity->getEmail()]);
            }

            $uniqid = uniqid("reset-", true) . '-' . $this->generateRandomString(5);

            $user->setResetPasswordHash($uniqid);
            $user->setResetPasswordDate(new \Datetime());
            $this->persist($user);

            $message = (new \Swift_Message())
                ->setSubject('Tianos: olvide mi password')
                ->setFrom('no-reply@' . $this->container->getParameter('application_url'))
                ->setTo($entity->getEmail())
                ->setBody(
                    $this->renderView(
                        '@UserBundle/Resources/views/BackendUser/Security/forgot-password-email.html.twig',
                        [
                            'user' => $user,
                            'uniqid' => $uniqid,
                        ]
                    ),
                    'text/html'
                )
            ;

            $this->get('mailer')->send($message);

            $this->flashSuccess('Se envio un link para re-establecer su password a: ' . $entity->getEmail() . '. Duracion del link: 24 horas.');

        }

        return $this->render($template, [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function resetPasswordStepTwoAction(Request $request): Response
    {

//        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
//        {
//            return $this->redirect($this->generateUrl('backend_dashboard_index'));
//        }

//        https://myaccount.google.com/lesssecureapps

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $vars = $configuration->getVars();


        $uniqid = $request->get('uniqid');
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $user = $this->get('tianos.repository.user')->findOneByUniqid($uniqid);

        if (is_null($user)) {
            $this->flashWarning('Usuario no existe. Re-intentar.');
            return $this->redirectToRoute('backend_security_reset_password_step_one');
        }

        $entity = new ChangePassword2();
        $form = $this->createForm(UserChangePasswordType2::class, $entity, [
//            'application_url' => $this->container->getParameter('application_url')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //password
            $plainPassword = $entity->getNewPassword();
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $plainPassword);

            //datetime yesterday
            $yesterday = new \DateTime();
            $yesterday->sub(new \DateInterval('P1D'));

            $user->setPassword($encoded);
            $user->setResetPasswordHash('');
            $user->setResetPasswordDate($yesterday);
            $this->persist($user);

            $this->flashSuccess('Password cambiado, puede iniciar sesión.');
            return $this->redirectToRoute('backend_security_login_admin');

        }

        return $this->render($template, [
            'vars' => $vars,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Login check action. This action should never be called.
     */
    public function checkAction(Request $request): Response
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    /**
     * Logout action. This action should never be called.
     */
    public function logoutAction(Request $request): Response
    {
        throw new \RuntimeException('You must configure the logout path to be handled by the firewall.');
    }

}
