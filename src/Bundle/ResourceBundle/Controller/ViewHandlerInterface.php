<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

interface ViewHandlerInterface
{
    /**
     * @param RequestConfiguration $requestConfiguration
     * @param View $view
     *
     * @return mixed
     */
    public function handle(RequestConfiguration $requestConfiguration, View $view): Response;
}
