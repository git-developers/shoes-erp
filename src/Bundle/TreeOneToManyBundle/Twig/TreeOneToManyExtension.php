<?php

declare(strict_types=1);

namespace Bundle\TreeOneToManyBundle\Twig;

use Bundle\TreeOneToManyBundle\Templating\Helper\TreeOneToManyHelper;
use Twig_Environment;

final class TreeOneToManyExtension extends \Twig_Extension
{
    /**
     * @var TreeOneToManyHelper
     */
    private $treeOneToManyHelper;

    /**
     * @param TreeOneToManyHelper $oneToManyHelper
     */
    public function __construct(TreeOneToManyHelper $treeOneToManyHelper)
    {
        $this->treeOneToManyHelper = $treeOneToManyHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_treeonetomany_render_button', [$this->treeOneToManyHelper, 'renderButton'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_treeonetomany_render_modal_footer', [$this->treeOneToManyHelper, 'renderModalFooter'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_treeonetomany_box_right_is_assigned', [$this->treeOneToManyHelper, 'boxRightIsAssigned']),
//            new \Twig_SimpleFunction('sylius_grid_render', [$this->gridHelper, 'renderOneToMany'], ['is_safe' => ['html']]),
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
