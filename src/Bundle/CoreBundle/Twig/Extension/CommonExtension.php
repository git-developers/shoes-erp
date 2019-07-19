<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Twig\Extension;

use Twig_Environment;
use Component\OneToMany\Definition\Action;

class CommonExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('array_search', [$this, 'arraySearchFilter']),
            new \Twig_SimpleFilter('in_array', [$this, 'in_arrayFilter']),
            new \Twig_SimpleFilter('is_array', [$this, 'is_arrayFilter']),
            new \Twig_SimpleFilter('badge_colors', [$this, 'badgeColorsFilter']),
            new \Twig_SimpleFilter('urldecode', [$this, 'urldecodeFilter']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('xxxxxxxxx', [$this, 'xxxxxxxxxFilter'], ['is_safe' => ['html'], 'needs_environment' => true] ),
            new \Twig_SimpleFunction('sliderBgColor', [$this, 'sliderBgColorFunction'] ),
            new \Twig_SimpleFunction('randomString', [$this, 'randomStringFunction'] ),
            new \Twig_SimpleFunction('randomBgColor', [$this, 'randomBgColorFunction'] ),
            new \Twig_SimpleFunction('randomBoxColor', [$this, 'randomBoxColorFunction'] ),
            new \Twig_SimpleFunction('randomCarouselColor', [$this, 'randomCarouselColorFunction'] ),
        ];
    }

    public function randomBgColorFunction()
    {
        $array = ['yellow', 'light-blue', 'aqua', 'green', 'yellow', 'red', 'teal', 'purple', 'orange', 'maroon'];
        $bgColor = $array[array_rand($array)];;

        return 'bg-' . $bgColor;
    }

    public function randomBoxColorFunction()
    {
        $array = ['primary', 'success', 'danger', 'warning', 'info', ''];
        $bgColor = $array[array_rand($array)];

        return 'box-' . $bgColor;
    }

    public function randomCarouselColorFunction()
    {
        $array = ['39CCCC', '3c8dbc', 'f39c12', '3c8dbc', '00c0ef', '00a65a', 'f39c12', 'dd4b39', '39cccc', '605ca8', 'ff851b', 'd81b60'];
        return $array[array_rand($array)];
    }

    public function randomStringFunction($length)
    {
        $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $multiplier = (int) ceil($length/strlen($x));
        $string = str_shuffle(str_repeat($x, $multiplier));

        return substr($string, 1, $length);
    }

    public function xxxxxxxxxFilter(\Twig_Environment $twig)
    {
        return $twig->render(
            'CoreBundle:Twig/Common:facebook_sdk.html.twig',
            [
                'test' => '',
            ]
        );
    }

    public function arraySearchFilter($needle, array $haystack)
    {
        return array_search($needle, $haystack);
    }

    public function in_arrayFilter($needle, array $haystack)
    {
        return in_array($needle, $haystack);
    }

    public function urldecodeFilter($str)
    {
        return urldecode($str);
    }

    public function is_arrayFilter($var)
    {
        return is_array($var);
    }

    public function badgeColorsFilter($index)
    {
        $badgeColors = [
            '',
            'bg-light-blue',
            'bg-aqua',
            'bg-green',
            'bg-yellow',
            'bg-red',
            'bg-navy',
            'bg-teal',
            'bg-purple',
            'bg-orange',
            'bg-maroon',
            'bg-black',
        ];

        return isset($badgeColors[$index]) ? $badgeColors[$index] : null;
    }


    public function sliderBgColorFunction()
    {
        $action = null;

        switch ($action){
            case Action::CREATE:
                $bg = 'green';
                break;
            case Action::EDIT:
                $bg = 'yellow';
                break;
            default:
                $bg = 'gray';
        }

        return 'bg-' . $bg . '-slider';
    }

    public function getName()
    {
        return 'common_extension';
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }
}

