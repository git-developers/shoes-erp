<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Twig;

use Bundle\OneToManyBundle\Templating\Helper\OneToManyHelper;
use Twig_Environment;

final class OneToManyExtension extends \Twig_Extension
{
    /**
     * @var OneToManyHelper
     */
    private $oneToManyHelper;

    /**
     * @param OneToManyHelper $oneToManyHelper
     */
    public function __construct(OneToManyHelper $oneToManyHelper)
    {
        $this->oneToManyHelper = $oneToManyHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_onetomany_render_button', [$this->oneToManyHelper, 'renderButton'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_onetomany_render_modal_footer', [$this->oneToManyHelper, 'renderModalFooter'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_onetomany_box_right_is_assigned', [$this->oneToManyHelper, 'boxRightIsAssigned']),
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
