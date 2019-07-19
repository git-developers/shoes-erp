<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\TreeToAssign\Builder\BoxMapper;
use CoreBundle\Services\TreeToAssign\Builder\BoxLeftMapper;
use CoreBundle\Services\TreeToAssign\Builder\BoxRightMapper;
use CoreBundle\Services\Common\Action;


class TreeToAssignController extends BaseController
{

    const AJAX_STATUS_BOXLEFT_NOT_VALUE = 'box_left_no_value';

    public function index(BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {

        $this->denyAccessUnlessGranted($boxMapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $box = $boxMapper->getDefaults();

        $leftMapper
            ->add('route_create', $leftMapper->switchRoute(Action::CREATE))
            ->add('route_create_child', $leftMapper->switchRoute(Action::CREATE_CHILD))
            ->add('route_edit', $leftMapper->switchRoute(Action::EDIT))
            ->add('route_view', $leftMapper->switchRoute(Action::VIEW))
            ->add('route_delete', $leftMapper->switchRoute(Action::DELETE))
            ->add('route_boxleft_has_boxright', $leftMapper->switchRoute(Action::BOXLEFT_HAS_BOXRIGHT))
        ;

        $rightMapper
            ->add('route_search', $rightMapper->switchRoute(Action::BOXRIGHT_SEARCH))
            ->add('route_assign', $rightMapper->switchRoute(Action::ASSIGN))
        ;

        $boxLeft = $leftMapper->getDefaults();
        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->findAllParents();
        $leftEntity = $this->getTreeEntities($boxLeft, $leftEntity);

        $boxRight = $rightMapper->getDefaults();
        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->findAll($boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        return $this->render(
            'CoreBundle:TreeToAssign:index.html.twig',
            [
                'box' => $box,
                'boxLeft' => $boxLeft,
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
        $boxRightIds = $rightMapper->handleSelectedId($request);
        $boxRightIdsToCreate = $boxMapper->getIdsToCreate($boxRightIds);
        $boxRightIdsToDelete = $boxMapper->getIdsToDelete($boxRightIds);

        $errors = [];
//        $assignedKeys = [];
        $status = self::AJAX_STATUS_ERROR;

        if(empty($boxLeftId)){
            $errors[] = self::AJAX_STATUS_BOXLEFT_NOT_VALUE;
        }

        try {
            $associativeBoxleftCollection = $box['assoc_boxleft_collection'];
            $associativeBoxrightCollection = $box['assoc_boxright_collection'];

            $boxLeftEntity = $this->em()->getRepository($boxLeft['class_path'])->findOneById($boxLeftId);

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
                        $boxRightEntity = $this->em()->getRepository($boxRight['class_path'])->findOneById($boxRightId);
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
            'status' => $status,
            'errors' => $errors,
        ]);
    }

    public function create(Request $request, BoxLeftMapper $leftMapper)
    {

        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($leftMapper->role(Action::CREATE))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::CREATE,
                ]
            );
        }

        $leftMapper
            ->add('template_create', $leftMapper->getFormTemplate())
        ;

        $boxLeft = $leftMapper->getDefaults();
        $options = array_merge($boxLeft['form_data'], ['parent_id' => null]);

        $entity = new $boxLeft['entity']();
        $form = $this->createForm($boxLeft['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $boxLeft['group_name']);
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
                'entity' => $entityJson,
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxLeft['template_create']),
            [
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function createChild(Request $request, BoxLeftMapper $leftMapper)
    {

        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($leftMapper->role(Action::CREATE_CHILD))) {
            return $this->render(
                'CoreBundle:Tree:Template/access_denied.html.twig',
                [
                    'action' => Action::CREATE_CHILD,
                ]
            );
        }

        $leftMapper
            ->add('template_create', $leftMapper->getFormTemplate())
        ;

        $boxLeft = $leftMapper->getDefaults();

        $parentId = $request->get('id');
        $options = array_merge($boxLeft['form_data'], ['parent_id' => $parentId]);

        $entity = new $boxLeft['entity']();
        $form = $this->createForm($boxLeft['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $boxLeft['group_name']);
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
                'entity' => $entityJson,
                'parent_id' => $parentId,
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxLeft['template_create']),
            [
                'formEntity' => $form->createView(),
                'id' => $parentId,
            ]
        );
    }

    public function edit(Request $request, BoxLeftMapper $leftMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($leftMapper->role(Action::EDIT))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::EDIT,
                ]
            );
        }

        $leftMapper
            ->add('template_edit', $leftMapper->getFormTemplate())
        ;

        $id = $request->get('id');
        $boxLeft = $leftMapper->getDefaults();
        $entity = $this->em()->getRepository($boxLeft['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('TREE: Unable to find  entity.');
        }

        $options = array_merge($boxLeft['form_data'], ['parent_id' => null]);
        //$options = array_merge($boxLeft['form_data'], ['parent_id' => $id]);
        $form = $this->createForm($boxLeft['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $boxLeft['group_name']);
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
                'entity' => $entityJson,
                'id' => $id,
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxLeft['template_edit']),
            [
                'formEntity' => $form->createView(),
                'id' => $id,
            ]
        );
    }

    public function delete(Request $request, BoxLeftMapper $leftMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($leftMapper->role(Action::DELETE))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::DELETE,
                ]
            );
        }

        $leftMapper
            ->add('template_delete', $leftMapper->getDeleteTemplate())
        ;

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $id = $request->get('id');
        $boxLeft = $leftMapper->getDefaults();

        if ($request->isMethod('DELETE')) {

            $repository = $this->em()->getRepository($boxLeft['class_path']);
            $entity = $repository->find($id);

            try {
                if($entity){
                    $entity->setIsActive(false);
                    //$this->remove($entity);
                    $this->persist($entity);

                    $children = $repository->findAllByParent($id);

                    if(is_array($children)){
                        foreach ($children as $key => $category){
                            $category->setIsActive(false);
                            $this->persist($entity);
                        }
                    }

                    $status = self::AJAX_STATUS_SUCCESS;
                }
            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
                'id' => $id,
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxLeft['template_delete']),
            [
                'id' => $id,
                'form_data' => $boxLeft['form_data'],
            ]
        );
    }

    public function boxRightSearch(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        $q = $rightMapper->handleSearchValue($request);

        $boxRight = $rightMapper->getDefaults();
        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->search($q, $boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        $boxRightAssigned = $this->boxRightAssigned($request, $boxMapper, $leftMapper, $rightMapper);

        return $this->render(
            'CoreBundle:TreeToAssign:Li/box_right.html.twig',
            [
                'boxRight' => $boxRight,
                'rightEntity' => $rightEntity,
                'boxRightAssigned' => $boxRightAssigned,
            ]
        );
    }

    private function boxRightAssigned(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

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

    public function boxleftHasBoxright(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxLeftId = $request->get('id');
        $boxRight = $rightMapper->getDefaults();
        $leftHasRight = $this->getLeftHasRightValues($boxLeftId, $boxMapper);

        return $this->render(
            'CoreBundle:TreeToAssign:Li/box_right.html.twig',
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

    public function info(Request $request, BoxMapper $boxMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $box = $boxMapper->getDefaults();

        return $this->render(
            $this->validateTemplate($box['template_info']),
            [
                'xxx' => '',
            ]
        );
    }

    private function getTreeEntities(array $tree, $parents)
    {
        if(is_null($parents)){
            $parents = [];
        }

        $entity = [];
        foreach ($parents as $key => $parent){

            $entity[$key]['parent'] = $this->getSerializeDecode($parent, $tree['group_name']);

            $children = $this->em()->getRepository($tree['class_path'])->findAllByParent($parent);
            $entity[$key]['children'] = $this->getTreeEntities($tree, $children);
        }

        return $entity;
    }

}