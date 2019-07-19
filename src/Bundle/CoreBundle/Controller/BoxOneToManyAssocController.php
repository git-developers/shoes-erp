<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Common\Action;
use CoreBundle\Services\BoxOneToManyAssoc\Builder\BoxMapper;
use CoreBundle\Services\BoxOneToManyAssoc\Builder\BoxLeftMapper;
use CoreBundle\Services\BoxOneToManyAssoc\Builder\BoxRightMapper;


class BoxOneToManyAssocController extends BaseController
{

    const AJAX_STATUS_BOXLEFT_NOT_VALUE = 'box_left_no_value';

    public function index(BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {

        $this->denyAccessUnlessGranted($boxMapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $boxMapper
            ->add('route_info', $boxMapper->switchRoute(Action::INFO))
            ->add('assoc_route_edit', $boxMapper->switchRoute(Action::ASSOCIATIVE_EDIT))
        ;

        $leftMapper
            ->add('route_search', $boxMapper->switchRoute(Action::BOXLEFT_SEARCH))
            ->add('route_select_item', $boxMapper->switchRoute(Action::BOXLEFT_HAS_BOXRIGHT))
        ;

        $rightMapper
            ->add('route_search', $boxMapper->switchRoute(Action::BOXRIGHT_SEARCH))
            ->add('route_select_item', $boxMapper->switchRoute(Action::ASSIGN))
        ;

        $box = $boxMapper->getDefaults();
        $boxLeft = $leftMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->findAll($boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->findAll($boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToManyAssoc:index.html.twig',
            [
                'box' => $box,
                'boxLeft' => $boxLeft,
                'boxRight' => $boxRight,
                'leftEntity' => $leftEntity,
                'rightEntity' => $rightEntity,
            ]
        );
    }

    public function assign(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $boxRightMapper)
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
        $boxRight = $boxRightMapper->getDefaults();

        $boxLeftId = $leftMapper->handleSelectedId($request);
        $boxRightIds = $boxRightMapper->handleSelectedId($request);
        $boxRightIdsToCreate = $boxMapper->getIdsToCreate($boxRightIds);
        $boxRightIdsToDelete = $boxMapper->getIdsToDelete($boxRightIds);

        $errors = [];
        //$assignedKeys = [];
        $status = self::AJAX_STATUS_ERROR;

        if(empty($boxLeftId)){
            $errors[] = self::AJAX_STATUS_BOXLEFT_NOT_VALUE;
        }

        try {
            $associativeBoxleftCollection = $box['assoc_boxleft_collection'];
            $associativeBoxrightCollection = $box['assoc_boxright_collection'];

            $boxLeftEntity = $this->em()->getRepository($boxLeft['class_path'])->find($boxLeftId);

            if($boxLeftEntity){

                // remove entradas pasadas
                foreach ($boxRightIdsToDelete as $key => $boxRightId){
                    $boxRightEntity = $this->em()->getRepository($box['assoc_class_path'])->findAssociatedEntity($boxLeftId, $boxRightId);

                    if($boxRightEntity){
                        $this->remove($boxRightEntity);
                    }
                }

                // add nuevas entradas
                $associativeBoxRightIds = $this->em()->getRepository($box['assoc_class_path'])->findBoxRightIdsByBoxLeftValue($boxLeftId);
                foreach ($boxRightIdsToCreate as $key => $boxRightId){
                    if(!in_array($boxRightId, $associativeBoxRightIds)){

                        $entity = clone new $box['assoc_entity']();
                        $boxRightEntity = $this->em()->getRepository($boxRight['class_path'])->find($boxRightId);
                        $entity->$associativeBoxleftCollection($boxLeftEntity);
                        $entity->$associativeBoxrightCollection($boxRightEntity);
                        $this->persist($entity);

//                        $assignedKeys[$boxRightId] = $entity->getIdIncrement();
                    }
                }

                $status = self::AJAX_STATUS_SUCCESS;
            }

        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }

        return $this->json([
            'errors' => $errors,
            'status' => $status,
        ]);
    }

    public function boxLeftSearch(Request $request, BoxLeftMapper $leftMapper)
    {
        $q = $leftMapper->handleSearchValue($request);
        $boxLeft = $leftMapper->getDefaults();

        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->search($q, $boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToManyAssoc:Li/box_left.html.twig',
            [
                'boxLeft' => $boxLeft,
                'leftEntity' => $leftEntity,
            ]
        );
    }

    public function boxRightSearch(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $boxRightMapper)
    {
        $q = $boxRightMapper->handleSearchValue($request);

        $boxRight = $boxRightMapper->getDefaults();

        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->search($q, $boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        $boxRightAssigned = $this->boxRightAssigned($request, $boxMapper, $leftMapper, $boxRightMapper);

        return $this->render(
            'CoreBundle:BoxOneToManyAssoc:Li/box_right.html.twig',
            [
                'boxRight' => $boxRight,
                'rightEntity' => $rightEntity,
                'boxRightAssigned' => $boxRightAssigned,
            ]
        );
    }

    private function boxRightAssigned(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $boxRightMapper)
    {
        $box = $boxMapper->getDefaults();
        $boxRight = $boxRightMapper->getDefaults();

        $boxLeftId = $leftMapper->handleSelectedId($request);
        $leftHasRight = $this->getLeftHasRightValues($boxLeftId, $boxMapper);

        $keys = [];
        $keys[BoxMapper::ID_ASSOCIATIVE] = [];
        $keys[BoxMapper::ID_LEFT_HAS_RIGHT] = [];
        foreach ($leftHasRight as $key => $value){

            $keys[BoxMapper::ID_ASSOCIATIVE][] = isset($value[$box['assoc_group_name_associative']]) ? $value[$box['assoc_group_name_associative']] : [];

            $value = isset($value[$boxRight['group_name']]) ? $value[$boxRight['group_name']] : [];
            $id = isset($value['id_increment']) ? $value['id_increment'] : null;

            $keys[BoxMapper::ID_LEFT_HAS_RIGHT][] = $id;
        }

        return $keys;
    }

    public function boxleftHasBoxright(Request $request, BoxMapper $boxMapper, BoxRightMapper $boxRightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxLeftId = $request->get('id');
        $boxRight = $boxRightMapper->getDefaults();
        $leftHasRight = $this->getLeftHasRightValues($boxLeftId, $boxMapper);

        return $this->render(
            'CoreBundle:BoxOneToManyAssoc:Li/box_right.html.twig',
            [
                'isAssigned' => true,
                'boxRight' => $boxRight,
                'rightEntity' => $leftHasRight,
            ]
        );

    }

    private function getLeftHasRightValues($boxLeftId, BoxMapper $boxMapper)
    {
        $box = $boxMapper->getDefaults();
        $leftHasRight = $this->em()->getRepository($box['assoc_class_path'])->findBoxleftHasBoxright($boxLeftId);
        return $this->getSerializeDecode($leftHasRight, $box['assoc_group_name']);
    }

    public function associativeEdit(Request $request, BoxMapper $boxMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxMapper
            ->add('assoc_template', $boxMapper->getAssociativeTemplate())
        ;

        $id = $request->get('id');

        $box = $boxMapper->getDefaults();

        $entity = $this->em()->getRepository($box['assoc_class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('BoxOneToMany: Unable to find  entity.');
        }

        $form = $this->createForm($box['assoc_form_type'], $entity, $box['assoc_form_data']);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $status = self::AJAX_STATUS_SUCCESS;
                }else{
                    foreach ($form->getErrors(true) as $key => $error) {
                        if ($form->isRoot()) {
                            $errors[] = $error->getMessage();
                        } else {
                            $errors[] = $error->getMessage();
                        }
                    }
                }

            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
            ]);
        }

        return $this->render(
            $this->validateTemplate($box['assoc_template']),
            [
                'formEntity' => $form->createView(),
                'id' => $id,
            ]
        );
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

}