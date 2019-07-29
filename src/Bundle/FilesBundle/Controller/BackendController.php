<?php

declare(strict_types=1);

namespace Bundle\FilesBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\GridBundle\Controller\GridController;
use Bundle\FilesBundle\Entity\Files;

class BackendController extends GridController
{
	
	const IMAGES = 'images';
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function openModalAction(Request $request): Response
	{
		
		if (!$this->isXmlHttpRequest()) {
			throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
		}
		
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$template = $configuration->getTemplate('');
		$formType = $configuration->getFormType();
		$action = $configuration->getAction();
		$entity = $configuration->getEntity();
		$vars = $configuration->getVars();
		
		$imagePath = null;
		
		//ALL
		$all = $request->request->all();
		$all = json_decode(json_encode($all));
		
		//CREATE FOLDER
		$this->createUploadFolder($all->fileType);
		
		//REPOSITORY
		$entity = $this->get($repository)->$method($all);
		
		if ($entity) {
			$ext = '.jpg';
			$uniqid = $entity->getUniqid();
			$imageName =  $uniqid . $ext;
			
			$imagineCacheManager = $this->get('liip_imagine.cache.manager');
			$imagePath = $imagineCacheManager->getBrowserPath('/upload/' . $all->fileType . '/' . $imageName, $all->filter);
		}
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);

		return $this->render(
			$template,
			[
				'id' => $all->id,
				'action' => $action,
				'filter' => $all->filter,
				'imagePath' => $imagePath,
				'fileType' => $all->fileType,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function createAction(Request $request): Response
	{

		if ($this->isPost() && !$this->isXmlHttpRequest()) {
			throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
		}
		
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$template = $configuration->getTemplate('');
		$formType = $configuration->getFormType();
		$action = $configuration->getAction();
		$entity = $configuration->getEntity();
		$vars = $configuration->getVars();
		$entity = new $entity();
		
		//ALL
		$all = $request->request->all();
		$all = json_decode(json_encode($all));
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		if (empty($_FILES)) {
			return $this->json([
				'status' => false,
				'message' => 'Verique el archivo (001).'
			]);
		}
		
		$files = array_shift($_FILES);
		$type = array_shift($files['type']);
		$sourcePath = array_shift($files['tmp_name']);
		
		if(is_uploaded_file($sourcePath)) {
			
			$ext = '.jpg';
			$uniqid = uniqid('', true);
			$imageName =  $uniqid . $ext;
			$targetPath = getcwd() . '/upload/' . $all->fileType . '/' . $imageName;
			
			if(move_uploaded_file($sourcePath, $targetPath)) {
				
				$imagineCacheManager = $this->get('liip_imagine.cache.manager');
				$imagePath = $imagineCacheManager->getBrowserPath('/upload/' . $all->fileType . '/' . $imageName, $all->filter);
				
				$entity->setUniqid($uniqid);
				$entity->setFilter($all->filter);
				$entity->setClassName($all->className);
				$entity->setMimeContentType($type);
				$entity->setFileType($all->fileType);
				$entity->setPkFileItem((int) $all->id);
				$this->upsert($repository, $entity);
				
				return $this->json([
					'status' => true,
					'imagePath' => $imagePath
				]);
			}
		}
		
		return $this->json([
			'status' => false,
			'message' => 'No se subio el archivo (002).'
		]);
	}
	
	private function upsert($repository, Files $newFile)
	{
		$entitySave = clone $newFile;
		$oldFile = $this->get($repository)->findOneByEntity2($newFile);
		
		if ($oldFile) {
			$this->deleteFile($oldFile);
			$oldFile->setUniqid($newFile->getUniqid());
			$entitySave = $oldFile;
		}
		
		$this->persist($entitySave);
	}
	
	private function createUploadFolder($folderName)
	{
		$filename = getcwd() . '/upload/' . $folderName;
		
		if (!file_exists($filename)) {
			mkdir($filename, 0775, true);
		}
	}
	
	private function deleteFile(Files $oldFile)
	{
		$ext = '.jpg';
		$imageName = $oldFile->getUniqid() . $ext;
		
		$targetPath1 = getcwd() . '/upload/' . $oldFile->getFileType() . '/' . $imageName;
		$targetPath2 = getcwd() . '/media/cache/' . $oldFile->getFilter() . '/upload/' . $oldFile->getFileType() . '/' . $imageName;
		
		if (file_exists($targetPath1)) {
			unlink($targetPath1);
		}
		
		if (file_exists($targetPath2)) {
			unlink($targetPath2);
		}
	}
	
}
