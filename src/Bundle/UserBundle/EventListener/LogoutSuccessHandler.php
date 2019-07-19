<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Routing\RouterInterface;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
	
	protected $httpUtils;
	protected $targetUrl;
	protected $authToken;
	protected $router;
	
	public function __construct(HttpUtils $httpUtils, string $targetUrl = '/', TokenStorageInterface $tokenStorage, RouterInterface $router)
	{
		$this->httpUtils = $httpUtils;
		$this->targetUrl = $targetUrl;
		$this->tokenStorage = $tokenStorage;
		$this->router = $router;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function onLogoutSuccess(Request $request)
	{
		
		$pdvSLug = $this->getPointOfSaleSLug();
		
		$this->targetUrl = $this->router->generate(
			$this->targetUrl,
			['slug' => $pdvSLug],
			UrlGeneratorInterface::ABSOLUTE_URL);
		
		return $this->httpUtils->createRedirectResponse($request, $this->targetUrl);
	}
	
	private function getUser()
	{
		$token = $this->tokenStorage->getToken();
		
		if (!$token instanceof TokenInterface) {
			return false;
		}
		
		$user = $token->getUser();
		
		if (!$user instanceof UserInterface) {
			return false;
		}
		
		return $user;
	}
	
	private function getPointOfSaleSLug()
	{
	
		$user = $this->getUser();
		
		if (!$user or !$user->getPointOfSaleActive() instanceof Pointofsale) {
			return false;
		}
		
		return $user->getPointOfSaleActive()->getSlug();
	}

}

