<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Bundle\RoleBundle\Entity\Role;
use Bundle\UserBundle\Entity\User;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    private $em;
    private $router;
	protected $httpUtils;

//    public function __construct(EntityManager $em, RouterInterface $router)
    public function __construct(ContainerInterface $container, RouterInterface $router)
    {
        $this->container = $container;
        $this->router = $router;
	    $this->httpUtils = $this->container->get('security.http_utils');
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
	
	    /**
	     * Set un PDV al USER
	     */
	    $user = $token->getUser();
//	    $user->setPointOfSaleActive(null);
	    $token->setUser($user);

	    $pointOfSale = $this->container->get('tianos.repository.pointofsale')->find($request->get('pointOfSale'));

	    if ($pointOfSale) {
//		    foreach ($pointOfSale->getUser() as $key => $userPdv) {
//			    if ($user->getId() == $userPdv->getId()) {
//				    $request->attributes->set(User::USER_BELONGS_TO_PDV, true);
//			    }
//		    }
//
//		    $user->setPointOfSaleActive($pointOfSale);
//		    $token->setUser($user);
        }
	    
	    $this->onAuthenticationSuccess($request, $token);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
	
	    return $this->httpUtils->createRedirectResponse($request, 'backend_dashboard_index');
    	
    	
	
	    /*
	    $user = $token->getUser();
	
	    if ($this->isGranted(Role::ROLE_PDV_ADMIN)) {
	    	
		    $referer = $this->router->generate('backend_dashboard_index');
		    $userBelongsToPdv = $request->attributes->get(User::USER_BELONGS_TO_PDV);

		    if (!$userBelongsToPdv) {
		    	
			    $o = new \stdClass();
			    $o->messageKey = 'El usuario no esta asociado al Punto de venta.';
			    $o->messageData = [];
			    
			    $request->getSession()->set(Security::AUTHENTICATION_ERROR, $o);
			    $referer = $this->router->generate('backend_security_login_admin',
				    ['slug' => $user->getPointOfSaleActiveSlug()]);
		    }
	    }
	
	    
	    if ($this->isGranted(Role::ROLE_SUPER_ADMIN)) {
		    $referer = $this->router->generate('backend_dashboard_index');
	    }
	
	    if ($this->isGranted(Role::ROLE_EMPLOYEE)) {
		    $referer = $this->router->generate('backend_dashboard_index');
	    }
	    */
	
	    //$referer = $this->router->generate('backend_dashboard_index', [], UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    private function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

}

