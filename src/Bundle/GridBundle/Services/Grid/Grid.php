<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Services\Grid;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Bundle\CoreBundle\Services\FormMapper;
use Bundle\CoreBundle\Services\ModalMapper;
use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;
use Bundle\GridBundle\Services\Grid\Builder\ButtonHeaderMapper;

class Grid
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
        return new ModalMapper($this->router);
    }

    public function getFormMapper()
    {
        return new FormMapper($this->router, $this->requestStack);
    }

    public function getDataTableMapper(array $grid = [])
    {
        return new DataTableMapper($grid);
    }

}