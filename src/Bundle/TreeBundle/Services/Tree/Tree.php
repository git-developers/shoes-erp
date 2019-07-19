<?php

declare(strict_types=1);

namespace Bundle\TreeBundle\Services\Tree;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Bundle\CoreBundle\Services\FormMapper;
use Bundle\CoreBundle\Services\ModalMapper;

class Tree
{

    protected $requestStack;
    protected $router;

    public function __construct(Router $router, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    public function getModalMapper()
    {
        return new ModalMapper($this->router, $this->requestStack);
    }

    public function getFormMapper()
    {
        return new FormMapper($this->router, $this->requestStack);
    }

}