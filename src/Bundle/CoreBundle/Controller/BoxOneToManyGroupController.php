<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Common\Action;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxMapper;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxLeftMapper;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxMiddleMapper;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxRightMapper;


class BoxOneToManyGroupController extends BaseController
{

    public function index(BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxMiddleMapper $middleMapper, BoxRightMapper $rightMapper)
    {

        $this->denyAccessUnlessGranted($boxMapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $boxMapper
            ->add('route_info', $boxMapper->switchRoute(Action::INFO))
        ;

        $leftMapper
            ->add('route_search', $boxMapper->switchRoute(Action::BOXLEFT_SEARCH))
            ->add('route_select_item', $boxMapper->switchRoute(Action::BOXLEFT_HAS_BOXRIGHT))
        ;

        $middleMapper
            ->add('route_assign_item', $boxMapper->switchRoute(Action::ASSIGN))
            ->add('route_unassign_item', $boxMapper->switchRoute(Action::UNASSIGN))
        ;

        $rightMapper
            ->add('route_search', $boxMapper->switchRoute(Action::BOXRIGHT_SEARCH))
        ;

        $box = $boxMapper->getDefaults();
        $boxMiddle = $middleMapper->getDefaults();

        $boxLeft = $leftMapper->getDefaults();
        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->findAll($boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        $boxRight = $rightMapper->getDefaults();
        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->findAll($boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToManyGroup:index.html.twig',
            [
                'box' => $box,
                'boxLeft' => $boxLeft,
                'boxMiddle' => $boxMiddle,
                'boxRight' => $boxRight,
                'leftEntity' => $leftEntity,
                'rightEntity' => $rightEntity,
            ]
        );

    }

    public function assign(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($boxMapper->role(Action::ASSIGN))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::ASSIGN,
                ]
            );
        }

        $box = $boxMapper->getDefaults();
        $boxLeft = $leftMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $boxLeftId = $leftMapper->handleSelectedId($request);
        $boxRightId = $rightMapper->handleSelectedId($request);

        $collectionAdd = $box['collection_add'];

        try {

            $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->find($boxLeftId);
            $rightEntity = $this->em()->getRepository($boxRight['class_path'])->find($boxRightId);

            $leftEntity->$collectionAdd($rightEntity);
            $this->persist($leftEntity);

            $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);
            $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        }catch (\Exception $e){
            $errors[] = $e->getMessage();

            return new Response();
        }

        return $this->render(
            'CoreBundle:BoxOneToManyGroup:Li/box_middle.html.twig',
            [
                'leftEntity' => $leftEntity,
                'rightEntity' => $rightEntity,
            ]
        );
    }

    public function unAssign(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $box = $boxMapper->getDefaults();
        $boxLeft = $leftMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $collectionRemove = $box['collection_remove'];

        try {

            $leftHasRight = $request->get('left_has_right');

            list($leftId, $rightId) = array_pad(explode(BoxMapper::SEPARATOR, $leftHasRight), 4, null);

            $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->find($leftId);
            $rightEntity = $this->em()->getRepository($boxRight['class_path'])->find($rightId);

            $leftEntity->$collectionRemove($rightEntity);
            $this->persist($rightEntity);

            $status = self::AJAX_STATUS_SUCCESS;

        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }

        return $this->json([
            'status' => $status,
            'errors' => $errors,
        ]);
    }

    public function boxLeftSearch(Request $request, BoxLeftMapper $leftMapper)
    {
        $q = $leftMapper->handleSearchValue($request);

        $boxLeft = $leftMapper->getDefaults();
        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->search($q, $boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToManyGroup:Li/box_left.html.twig',
            [
                'boxLeft' => $boxLeft,
                'leftEntity' => $leftEntity,
            ]
        );
    }

    public function boxRightSearch(Request $request, BoxRightMapper $rightMapper)
    {
        $q = $rightMapper->handleSearchValue($request);

        $boxRight = $rightMapper->getDefaults();
        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->search($q, $boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToManyGroup:Li/box_right.html.twig',
            [
                'boxRight' => $boxRight,
                'rightEntity' => $rightEntity,
            ]
        );
    }

    public function boxleftHasBoxright(Request $request, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxLeftId = $request->get('id');

        $boxLeft = $leftMapper->getDefaults();
        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->find($boxLeftId);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        $leftHasRight = $this->getLeftHasRightValues($boxLeftId, $leftMapper, $rightMapper);

        return $this->render(
            'CoreBundle:BoxOneToManyGroup:Li/box_middle_loop.html.twig',
            [
                'leftEntity' => $leftEntity,
                'leftHasRight' => $leftHasRight,
            ]
        );
    }

    private function getLeftHasRightValues($boxLeftId, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        $boxLeft = $leftMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();
        $rightEntity = $this->em()->getRepository($boxLeft['class_path'])->findAllByBoxLeftId($boxLeftId);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxLeft['group_name_join']);
        $rightEntity = array_shift($rightEntity);
        return isset($rightEntity[$boxRight['group_name']]) ? $rightEntity[$boxRight['group_name']] : [];
    }

    public function info(Request $request, BoxMapper $boxMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxMapper
            ->add('template_info', $boxMapper->getInfoTemplate())
        ;

        $box = $boxMapper->getDefaults();

        return $this->render(
            $this->validateTemplate($box['template_info']),
            [
                'xxx' => '',
            ]
        );
    }

//    protected function getInformativeTemplate($view, $action)
//    {
//        $bundle = $this->getBundleName();
//        return $bundle . ':' . $view . ':Informative/' . strtolower($action) . '.html.twig';
//    }
}