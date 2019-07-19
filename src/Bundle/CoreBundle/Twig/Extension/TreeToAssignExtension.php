<?php

namespace Bundle\CoreBundle\Twig\Extension;

class TreeToAssignExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('xxxxxArray', [$this, 'xxxxxxFilter']),
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

    public function xxxxxxFilter(array $entity = [], array $boxRight = [])
    {
//        return isset($entity[$boxRight['group_name']]);
    }

    public function getName()
    {
        return 'treetoassign_extension';
    }

}

