<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Tree\Builder\TreeMapper;
use CoreBundle\Services\Common\Action;

class TreeController extends BaseController
{

    public function index(TreeMapper $mapper)
    {

        $this->denyAccessUnlessGranted($mapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $mapper
            ->add('route_create', $mapper->switchRoute(Action::CREATE))
            ->add('route_create_child', $mapper->switchRoute(Action::CREATE_CHILD))
            ->add('route_edit', $mapper->switchRoute(Action::EDIT))
            ->add('route_view', $mapper->switchRoute(Action::VIEW))
            ->add('route_delete', $mapper->switchRoute(Action::DELETE))
//            ->add('route_info', $mapper->switchRoute(Action::INFO))
        ;

        $tree = $mapper->getDefaults();
        $parents = $this->em()->getRepository($tree['class_path'])->findAllParents();
        $entity = $this->getTreeEntities($tree, $parents);

        return $this->render(
            'CoreBundle:Tree:index.html.twig',
            [
                'tree' => $tree,
                'entity' => $entity,
            ]
        );
    }

    public function create(Request $request, TreeMapper $mapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($mapper->role(Action::CREATE))) {
            return $this->render(
                'CoreBundle:Tree:Template/access_denied.html.twig',
                [
                    'action' => Action::CREATE,
                ]
            );
        }

        $mapper
            ->add('template_create', $mapper->getFormTemplate())
        ;

        $tree = $mapper->getDefaults();
        $entity = new $tree['class_path']();
        $options = array_merge($tree['form_data'], ['parent_id' => null]);
        $form = $this->createForm($tree['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $tree['group_name']);
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
            $this->validateTemplate($tree['template_create']),
            [
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function createchild(Request $request, TreeMapper $mapper)
    {

        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($mapper->role(Action::CREATE_CHILD))) {
            return $this->render(
                'CoreBundle:Tree:Template/access_denied.html.twig',
                [
                    'action' => Action::CREATE_CHILD,
                ]
            );
        }

        $mapper
            ->add('template_create', $mapper->getFormTemplate())
        ;

        $tree = $mapper->getDefaults();

        $id = $request->get('id');
        $options = array_merge($tree['form_data'], ['parent_id' => $id]);

        $entity = new $tree['class_path']();
        $form = $this->createForm($tree['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $tree['group_name']);
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
            $this->validateTemplate($tree['template_create']),
            [
                'formEntity' => $form->createView(),
                'id' => $id,
            ]
        );
    }

    public function edit(Request $request, TreeMapper $mapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($mapper->role(Action::EDIT))) {
            return $this->render(
                'CoreBundle:Tree:Template/access_denied.html.twig',
                [
                    'action' => Action::EDIT,
                ]
            );
        }

        $mapper
            ->add('template_edit', $mapper->getFormTemplate())
        ;

        $id = $request->get('id');
        $tree = $mapper->getDefaults();
        $entity = $this->em()->getRepository($tree['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('TREE: Unable to find  entity.');
        }

        $options = array_merge($tree['form_data'], ['parent_id' => null]);
//        $options = array_merge($tree['form_data'], ['parent_id' => $id]);
        $form = $this->createForm($tree['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $tree['group_name']);
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
            $this->validateTemplate($tree['template_edit']),
            [
                'formEntity' => $form->createView(),
                'id' => $id,
            ]
        );
    }

    public function delete(Request $request, TreeMapper $mapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($mapper->role(Action::DELETE))) {
            return $this->render(
                'CoreBundle:Tree:Template/access_denied.html.twig',
                [
                    'action' => Action::DELETE,
                ]
            );
        }

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $id = $request->get('id');
        $tree = $mapper->getDefaults();

        if ($request->isMethod('DELETE')) {

            $repository = $this->em()->getRepository($tree['class_path']);
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
            'CoreBundle:Tree:Template/delete.html.twig',
            [
                'id' => $id,
            ]
        );
    }

    public function view(Request $request, TreeMapper $mapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($mapper->role(Action::VIEW))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::VIEW,
                ]
            );
        }

        $mapper
            ->add('template_view', $mapper->getViewTemplate())
        ;

        $id = $request->get('id');
        $tree = $mapper->getDefaults();
        $entity = $this->em()->getRepository($tree['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('TREE: Unable to find  entity.');
        }

        return $this->render(
            $this->validateTemplate($tree['template_view']),
            [
                'entity' => $entity,
            ]
        );
    }

    public function info(Request $request, TreeMapper $mapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $tree = $mapper->getDefaults();

        return $this->render(
            $this->validateTemplate($tree['template_info']),
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