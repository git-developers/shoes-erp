<?php

declare(strict_types=1);

namespace Bundle\TreeBundle\Twig;

use Bundle\TreeBundle\Templating\Helper\TreeHelper;
use Twig_Environment;

final class TreeExtension extends \Twig_Extension
{
    /**
     * @var TreeHelper
     */
    private $gridHelper;

    /**
     * @param TreeHelper $gridHelper
     */
    public function __construct(TreeHelper $gridHelper)
    {
        $this->gridHelper = $gridHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_grid_render_button', [$this->gridHelper, 'renderButton'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_grid_render_modal_footer', [$this->gridHelper, 'renderModalFooter'], ['is_safe' => ['html']]),
//            new \Twig_SimpleFunction('sylius_grid_render', [$this->gridHelper, 'renderTree'], ['is_safe' => ['html']]),
//            new \Twig_Function('sylius_grid_render_field', [$this->gridHelper, 'renderField'], ['is_safe' => ['html']]),
//            new \Twig_Function('sylius_grid_render_action', [$this->gridHelper, 'renderAction'], ['is_safe' => ['html']]),
//            new \Twig_Function('sylius_grid_render_filter', [$this->gridHelper, 'renderFilter'], ['is_safe' => ['html']]),
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
