<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Twig;

use Bundle\GridBundle\Templating\Helper\GridHelper;
use Twig_Environment;

final class GridExtension extends \Twig_Extension
{
    /**
     * @var GridHelper
     */
    private $gridHelper;

    /**
     * @param GridHelper $gridHelper
     */
    public function __construct(GridHelper $gridHelper)
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
            new \Twig_SimpleFunction('tianos_grid_form_js', [$this->gridHelper, 'renderFormJs'], ['is_safe' => ['html']]),
//            new \Twig_SimpleFunction('sylius_grid_render', [$this->gridHelper, 'renderGrid'], ['is_safe' => ['html']]),
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
