<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Common\Action;
use CoreBundle\Services\ListHasTree\Builder\BoxMapper;
use CoreBundle\Services\ListHasTree\Builder\BoxLeftMapper;
use CoreBundle\Services\ListHasTree\Builder\BoxRightMapper;


class ListHasTreeController extends BaseController
{

    public function index(BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {

        $this->denyAccessUnlessGranted($boxMapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $boxMapper
            ->add('route_info', $boxMapper->switchRoute(Action::INFO))
        ;

        $leftMapper
            ->add('route_search', $boxMapper->switchRoute(Action::BOXLEFT_SEARCH))
            ->add('route_select_item', $boxMapper->switchRoute(Action::BOXLEFT_HAS_BOXRIGHT))
        ;

        $rightMapper
            ->add('route_assign', $rightMapper->switchRoute(Action::BOXRIGHT_ASSIGN))
            ->add('route_unassign', $rightMapper->switchRoute(Action::BOXRIGHT_UNASSIGN))
            ->add('route_assign_view', $rightMapper->switchRoute(Action::BOXRIGHT_ASSIGN_VIEW))
            ->add('route_assign_edit', $rightMapper->switchRoute(Action::BOXRIGHT_ASSIGN_EDIT))
            ->add('route_assign_child', $rightMapper->switchRoute(Action::BOXRIGHT_ASSIGN_CHILD))
        ;

        $box = $boxMapper->getDefaults();
        $boxLeft = $leftMapper->getDefaults();
        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->findAll($boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        $boxRight = $rightMapper->getDefaults();

        return $this->render(
            'CoreBundle:ListHasTree:index.html.twig',
            [
                'box' => $box,
                'boxLeft' => $boxLeft,
                'boxRight' => $boxRight,
                'leftEntity' => $leftEntity,
            ]
        );
    }

    public function boxleftHasBoxright(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxLeftId = $request->get('id');
        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();
        $leftHasRight = $this->getLeftHasRightValues($boxLeftId, $boxMapper, $leftMapper);

        return $this->render(
            'CoreBundle:ListHasTree:Li/1_box_right.html.twig',
            [
                'box' => $box,
                'boxRight' => $boxRight,
                'leftHasRight' => $leftHasRight,
            ]
        );
    }

    private function getLeftHasRightValues($boxLeftId, BoxMapper $boxMapper, BoxLeftMapper $leftMapper)
    {
        $box = $boxMapper->getDefaults();
        $leftHasRight = $this->em()->getRepository($box['assign_class_path'])->findBoxleftHasBoxrightParent($boxLeftId);
        return $this->getTreeEntities($box, $leftHasRight);
    }

    private function getTreeEntities(array $box, $parents)
    {
        if(is_null($parents)){
            $parents = [];
        }

        $entity = [];
        foreach ($parents as $key => $parent){

            $entity[$key]['parent'] = $this->getSerializeDecode($parent, $box['assign_group_name']);

            $children = $this->em()->getRepository($box['assign_class_path'])->findAllByParent($parent);
            $entity[$key]['children'] = $this->getTreeEntities($box, $children);
        }

        return $entity;
    }

    public function boxLeftSearch(Request $request, BoxLeftMapper $leftMapper)
    {
        $q = $leftMapper->handleSearchValue($request);
        $boxLeft = $leftMapper->getDefaults();

        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->search($q, $boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        return $this->render(
            'CoreBundle:ListHasTree:Li/box_left.html.twig',
            [
                'boxLeft' => $boxLeft,
                'leftEntity' => $leftEntity,
            ]
        );
    }

    public function boxRightAssign(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
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

        $rightMapper
            ->add('template_create', $rightMapper->getFormTemplate())
        ;

        $newObject = true;
        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $entity = new $box['assign_class_path']();

        $array = [
            'left_selected_value' => $leftMapper->handleSelectedId($request),
            'parent' => null,
        ];
        $options = array_merge($box['assign_form_data'], $array);
        $form = $this->createForm($box['assign_form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $entity->setIsParent(true);
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $box['assign_group_name']);
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
                'new_object' => $newObject,
                'entity' => $entityJson,
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxRight['template_create']),
            [
                'box' => $box,
                'boxRight' => $boxRight,
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function boxRightAssignEdit(Request $request, BoxMapper $boxMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $rightMapper
            ->add('template_edit', $rightMapper->getFormTemplate('Form', 'form_edit'))
        ;

        $id = $request->get('id');
        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $entity = $this->em()->getRepository($box['assign_class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('LIST HAS TREE: Unable to find  entity.');
        }

        $form = $this->createForm($box['assign_form_edit_type'], $entity, $box['assign_form_data']);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
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
                'id' => $id,
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxRight['template_edit']),
            [
                'id' => $id,
                'box' => $box,
                'boxRight' => $boxRight,
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function boxRightAssignChild(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $rightMapper
            ->add('template_create', $rightMapper->getFormTemplate())
        ;

        $newObject = true;
        $parent = $request->get('parent');

        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $entity = new $box['assign_class_path']();

        $array = [
            'left_selected_value' => $leftMapper->handleSelectedId($request),
            'parent' => $parent,
        ];
        $options = array_merge($box['assign_form_data'], $array);
        $form = $this->createForm($box['assign_form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $box['assign_group_name']);
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
                'new_object' => $newObject,
                'entity' => $entityJson,
                'parent_id' => $entity->getTemplateHasModule()->getIdIncrement(),
            ]);
        }

        return $this->render(
            $this->validateTemplate($boxRight['template_create']),
            [
                'box' => $box,
                'boxRight' => $boxRight,
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function boxRightUnAssign(Request $request, BoxMapper $boxMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $box = $boxMapper->getDefaults();

        try {

            $leftHasRight = $request->get('left_has_right');
            $leftHasRight = $this->em()->getRepository($box['assign_class_path'])->find($leftHasRight);
            $leftHasRight->setIsActive(false);
            $this->persist($leftHasRight);

            $this->unAssignChildren($boxMapper, $leftHasRight);

            $status = self::AJAX_STATUS_SUCCESS;

        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }

        return $this->json([
            'status' => $status,
            'errors' => $errors,
        ]);
    }

    public function boxRightAssignView(Request $request, BoxMapper $boxMapper, BoxRightMapper $rightMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $rightMapper
            ->add('template_view', $rightMapper->getViewTemplate())
        ;

        $id = $request->get('id');
        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();
        $entity = $this->em()->getRepository($box['assign_class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        return $this->render(
            $this->validateTemplate($boxRight['template_view']),
            [
                'entity' => $entity,
            ]
        );
    }

    private function unAssignChildren(BoxMapper $boxMapper, $leftHasRight)
    {
        $box = $boxMapper->getDefaults();
        $leftHasRightChilds = $this->em()->getRepository($box['assign_class_path'])->findAllByParent($leftHasRight);

        foreach ($leftHasRightChilds as $key => $entity){
            $entity->setIsActive(false);
            $this->persist($entity);

            $this->unAssignChildren($boxMapper, $entity);
        }

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