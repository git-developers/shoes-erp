<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Twig;

use Bundle\UserBundle\Templating\Helper\UserHelper;
use Twig_Environment;

final class UserExtension extends \Twig_Extension
{
    /**
     * @var UserHelper
     */
    private $userHelper;

    /**
     * @param UserHelper $userHelper
     */
    public function __construct(UserHelper $userHelper)
    {
        $this->userHelper = $userHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_profile_about_me', [$this->userHelper, 'profileAboutMe'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_app_user_name', [$this->userHelper, 'appUserName'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_reverse_recursive_category', [$this->userHelper, 'reverseRecursiveCategory'], ['is_safe' => ['html']]),
        ];
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }
}
