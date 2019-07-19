<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Template\Builder\TemplateMapper;
use CoreBundle\Services\Crud\Builder\CrudMapper;


class TemplateController extends BaseController
{

    public function info(Request $request, TemplateMapper $templateMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            return;
        }

        $templateMapper
            ->add('template_info', $templateMapper->getInfoTemplate())
        ;

        $template = $templateMapper->getDefaults();

        return $this->render(
            $this->validateTemplate($template['template_info']),
            [
                'xxx' => '',
            ]
        );
    }

}