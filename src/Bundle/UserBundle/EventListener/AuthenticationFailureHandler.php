<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Core\Security;

final class AuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
//class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{

    private $container;
	protected $httpUtils;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
	    $this->httpUtils = $this->container->get('security.http_utils');
    }
	
	/**
	 * {@inheritdoc}
	 */
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
	{

		if ($request->isXmlHttpRequest()) {
			return new JsonResponse(['success' => false, 'message' => $exception->getMessageKey()], 401);
		}
		
		$o = new \stdClass();
		$o->messageKey = 'Usuario o contraseña incorrecto.';
		$o->messageData = [];
		
		$request->getSession()->set(Security::AUTHENTICATION_ERROR, $o);
		$this->options['failure_path'] = $request->headers->get('referer');
		
		return $this->httpUtils->createRedirectResponse($request, $this->options['failure_path']);
		
//		return parent::onAuthenticationFailure($request, $exception);
	}

}
