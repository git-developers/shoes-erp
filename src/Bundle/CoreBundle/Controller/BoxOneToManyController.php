<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Common\Action;
use CoreBundle\Services\BoxOneToMany\Builder\BoxMapper;
use CoreBundle\Services\BoxOneToMany\Builder\BoxLeftMapper;
use CoreBundle\Services\BoxOneToMany\Builder\BoxRightMapper;


class BoxOneToManyController extends BaseController
{

    public function index(BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {

        $this->denyAccessUnlessGranted($boxMapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $boxMapper
            ->add('route_info', $boxMapper->switchRoute(Action::INFO))
        ;

        $leftMapper
            ->add('route_search', $leftMapper->switchRoute(Action::BOXLEFT_SEARCH))
            ->add('route_select_item', $leftMapper->switchRoute(Action::BOXLEFT_HAS_BOXRIGHT))
        ;

        $rightMapper
            ->add('route_search', $rightMapper->switchRoute(Action::BOXRIGHT_SEARCH))
            ->add('route_select_item', $rightMapper->switchRoute(Action::ASSIGN))
        ;

        $box = $boxMapper->getDefaults();

        $boxLeft = $leftMapper->getDefaults();
        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->findAll($boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        $boxRight = $rightMapper->getDefaults();
        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->findAll($boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToMany:index.html.twig',
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
        $status = self::AJAX_STATUS_ERROR;

//        if(empty($boxLeftId)){
//            $errors[] = self::AJAX_STATUS_BOXLEFT_NOT_VALUE;
//        }

        try {

            $collectionGet = $box['collection_get'];
            $collectionAdd = $box['collection_add'];
            $collectionRemove = $box['collection_remove'];
            $boxLeftEntity = $this->em()->getRepository($boxLeft['class_path'])->findOneById($boxLeftId);

            if($boxLeftEntity){

                // remove entradas pasadas
                foreach ($boxLeftEntity->$collectionGet() as $key => $leftEntity){
                    if(in_array($leftEntity->getIdIncrement(), $boxRightIdsToDelete)){
                        $boxLeftEntity->$collectionRemove($leftEntity);
                        $this->persist($leftEntity);
                    }
                }

                // add nuevas entradas
                foreach ($boxRightIdsToCreate as $key => $boxRightId){
                    $boxRightEntity = $this->em()->getRepository($boxRight['class_path'])->findOneById($boxRightId);

                    if (!$boxLeftEntity->$collectionGet()->contains($boxRightEntity)) {
                        $boxLeftEntity->$collectionAdd($boxRightEntity);
                        $this->persist($boxRightEntity);
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

    public function boxLeftSearch(Request $request, BoxLeftMapper $leftMapper)
    {
        $q = $leftMapper->handleSearchValue($request);
        $boxLeft = $leftMapper->getDefaults();

        $leftEntity = $this->em()->getRepository($boxLeft['class_path'])->search($q, $boxLeft['limit']);
        $leftEntity = $this->getSerializeDecode($leftEntity, $boxLeft['group_name']);

        return $this->render(
            'CoreBundle:BoxOneToMany:Li/box_left.html.twig',
            [
                'boxLeft' => $boxLeft,
                'leftEntity' => $leftEntity,
            ]
        );
    }

    public function boxRightSearch(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper, BoxRightMapper $rightMapper)
    {
        $q = $rightMapper->handleSearchValue($request);

        $box = $boxMapper->getDefaults();
        $boxRight = $rightMapper->getDefaults();

        $rightEntity = $this->em()->getRepository($boxRight['class_path'])->search($q, $boxRight['limit']);
        $rightEntity = $this->getSerializeDecode($rightEntity, $boxRight['group_name']);

        $boxRightAssignedKeys = $this->getBoxRightAssignedkeys($request, $boxMapper, $leftMapper);

        return $this->render(
            'CoreBundle:BoxOneToMany:Li/box_right.html.twig',
            [
                'action' => $box['action_create'],
                'boxRight' => $boxRight,
                'rightEntity' => $rightEntity,
                'boxRightAssignedKeys' => $boxRightAssignedKeys,
            ]
        );
    }

    private function getBoxRightAssignedkeys(Request $request, BoxMapper $boxMapper, BoxLeftMapper $leftMapper)
    {
        $boxLeftId = $leftMapper->handleSelectedId($request);
        $leftHasRight = $this->getLeftHasRightValues($boxLeftId, $boxMapper, $leftMapper);

        $keys = [];
        foreach ($leftHasRight as $key => $entity){
            $keys[] = isset($entity['id_increment']) ? $entity['id_increment'] : null;
        }

        return $keys;
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
            'CoreBundle:BoxOneToMany:Li/box_right.html.twig',
            [
                'isAssigned' => true,
                'action' => $box['action_delete'],
                'boxRight' => $boxRight,
                'rightEntity' => $leftHasRight,
            ]
        );

    }

    private function getLeftHasRightValues($boxLeftId, BoxMapper $boxMapper, BoxLeftMapper $leftMapper)
    {
        $box = $boxMapper->getDefaults();
        $boxLeft = $leftMapper->getDefaults();

        $leftHasRight = $this->em()->getRepository($boxLeft['class_path'])->findBoxleftHasBoxright($boxLeftId);
        $leftHasRight = $this->getSerializeDecode($leftHasRight, $box['assoc_group_name']);
        $leftHasRight = is_array($leftHasRight) ? array_shift($leftHasRight) : [];
        $leftHasRight = isset($leftHasRight[$box['assoc_group_name_key']]) ? $leftHasRight[$box['assoc_group_name_key']] : [];

        return $leftHasRight;
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