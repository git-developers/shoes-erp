<?php

namespace Bundle\CoreBundle\Twig\Extension;

use CoreBundle\Services\Common\Action;
use Symfony\Component\HttpFoundation\RequestStack;

class CrudExtension extends \Twig_Extension
{

    const CLOSED_LEFT = '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>';
    const CLOSED_RIGHT_DEFAULT = '<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>';
    const CLOSED_RIGHT_OUTLINE = '<button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cerrar</button>';
    const SAVE = '<button type="submit" class="btn btn-outline">Guardar</button>';
    const CHANGE_PASSWORD = '<button type="submit" class="btn btn-outline">Cambiar password</button>';
    const DELETE = '<button type="submit" class="btn btn-outline">Eliminar</button>';

    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('xxxxxxxx', [$this, 'xxxxxxxxxFilter']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('modal_footer', [$this, 'modalFooterFunction'] ),
            new \Twig_SimpleFunction('modal_footer_access_denied', [$this, 'modalFooterAccessDeniedFunction'] ),
        ];
    }

    public function modalFooterAccessDeniedFunction()
    {
        $action = $this->getAction();

        switch ($action){
            case Action::EDIT:
            case Action::INFO:
            case Action::DELETE:
            case Action::CREATE:
            case Action::CREATE_CHILD:
            case Action::CHANGE_PASSWORD:
                return self::CLOSED_RIGHT_OUTLINE;
                break;
            case Action::VIEW:
                return self::CLOSED_RIGHT_DEFAULT;
                break;
        }
    }

    public function modalFooterFunction()
    {
        $action = $this->getAction();

        switch ($action){
            case Action::EDIT:
            case Action::CREATE:
            case Action::CREATE_CHILD:
                return self::CLOSED_LEFT . self::SAVE;
                break;
            case Action::CHANGE_PASSWORD:
                return self::CLOSED_LEFT . self::CHANGE_PASSWORD;
                break;
            case Action::DELETE:
                return self::CLOSED_LEFT . self::DELETE;
                break;
            case Action::VIEW:
                return self::CLOSED_RIGHT_DEFAULT;
                break;
            case Action::INFO:
                return self::CLOSED_RIGHT_OUTLINE;
                break;
        }
    }

    private function getAction()
    {
        $request = $this->requestStack->getCurrentRequest();
        $controller = $request->attributes->get('_controller');
        $action = explode('::', $controller);
        $action = end($action);
        return str_replace(Action::ACTION, '', $action);
    }

    public function xxxxxxxxxFilter(\Twig_Environment $twig)
    {
        return;
    }

    public function getName()
    {
        return 'crud_extension';
    }

}

