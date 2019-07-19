<?php

namespace Bundle\CoreBundle\Twig\Extension;

class BoxMapperExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('idParent', [$this, 'idParentFilter']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('xxxxxxxxx', [$this, 'xxxxxxxxxFunction'], ['is_safe' => ['html'], 'needs_environment' => true] ),
        ];
    }

    public function xxxxxxxxxFunction()
    {
        return;
    }

    public function idParentFilter($needle, array $haystack)
    {
        $leftHasRight = $haystack['left_has_right'];
        $idAssociative = $haystack['id_associative'];

        $key = array_search($needle, $leftHasRight);

        if(is_numeric($key)){
            return $idAssociative[$key];
        }

        return;
    }

    public function getName()
    {
        return 'boxmapper_extension';
    }

}

