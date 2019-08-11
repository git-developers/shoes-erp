<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Bundle\ProductBundle\Entity\Product;

abstract class BaseController extends Controller
{


//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
//        ]);
//    }


//
    const ACCESS_DENIED_MSG = 'Tianos: Access Denied';
//    const ACCESS_DENIED_ROLE_MSG = 'Tianos: no tiene permisos, contacte a su administrador.';
//    const NOT_FOUND_MSG = 'Tianos Base controller: no se encontro el entity';
	
	const GET = 'GET';
	const POST = 'POST';
    
    const STATUS_SUCCESS = true;
    const STATUS_ERROR = false;

    const STATUS_SUCCESS_API = 1;
    const STATUS_WARNING_API = 2;
    const STATUS_ERROR_API = 3;

    const MAX_AGE_HOUR = 3600; #cache for 300 seconds
    const MAX_AGE_WEEK = 604800; #cache for 604800 seconds
    const MAX_AGE_YEAR = 31622400; #cache for 31622400 seconds
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';

    protected function em()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function persist($entity)
    {
        // "The EntityManager is closed." issue.
        if (!$this->em()->isOpen()) {
            $this->getDoctrine()->resetManager();
        }

        $this->em()->persist($entity);
        $this->em()->flush();
    }

    protected function remove($entity)
    {
        // "The EntityManager is closed." issue.
        if (!$this->em()->isOpen()) {
            $this->getDoctrine()->resetManager();
        }

        $this->em()->remove($entity);
        $this->em()->flush();
    }

    protected function getSerializeDecode($object, $groupName)
    {
        $objects = $this->getSerialize($object, $groupName);
        return json_decode($objects, true);
    }

    protected function getSerialize($object, $groupName)
    {
        $serializer = $this->container->get('jms_serializer');

        return $serializer->serialize(
            $object,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
        );
    }

    protected function redirectUrl($url, $day = 1)
    {
        $url = $this->generateUrl($url);
        $redirect = new RedirectResponse($url);
        $redirect->setExpires(new \DateTime('+'.$day.' day'));
        return $redirect;
    }

    protected function flashAlertSuccess($message)
    {
        $this->addFlash('alert_success', $message);
    }

    protected function flashAlertWarning($message)
    {
        $this->addFlash('alert_warning', $message);
    }

    protected function flashAlertError($message)
    {
        $this->addFlash('alert_error', $message);
    }

    protected function flashSuccess($message)
    {
        $this->addFlash('success', $message);
    }

    protected function flashWarning($message)
    {
        $this->addFlash('warning', $message);
    }

    protected function flashError($message)
    {
        $this->addFlash('error', $message);
    }

    protected function notFound($message = 'Not Found', \Exception $previous = null)
    {
        throw $this->createNotFoundException($message, $previous);
    }

    protected function isXmlHttpRequest()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        return $request->isXmlHttpRequest() || $request->get('_xml_http_request');
//        return 'XMLHttpRequest' == $this->headers->get('X-Requested-With');
    }

    protected function contentTypeValidation(Request $request)
    {
        $content = $request->headers->get('Content-Type');

        if(strpos($content, self::CONTENT_TYPE_APPLICATION_JSON) !== 0){
            throw new BadRequestHttpException('Tianos: content-type not allowed');
        }
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] === self::GET;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === self::POST;
    }
	
	protected function rowImages($objects): array
	{
		
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		
		$out = [];
		foreach ($objects as $i => $object) {
			
			if (!method_exists($object,'setFiles')) {
				$out[] = $object;
				continue;
			}
			
			$files = $this->get("tianos.repository.files")->findAllByEntity($object);
			
			$imagePath = [];
			foreach ($files as $j => $file) {
				$imagePath[] = $imagineCacheManager->getBrowserPath(
					'/upload/' . $file->getFileType() . '/' . $file->getUniqid() . '.jpg',
					$file->getFilter()
				);
			}
			
			$object->setFiles($imagePath);
			
			$out[] = $object;
		}
		
		return $out;
	}
	
	protected function rowImagesProduct($objects): array
	{
		
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		
		$out = [];
		foreach ($objects as $i => $object) {
			
			if (!method_exists($object->getProduct(),'setFiles')) {
				$out[] = $object;
				continue;
			}
			
			$files = $this->get("tianos.repository.files")->findAllByClass(
				(new \ReflectionClass(new Product()))->getShortName(),
				$object->getId()
			);
			
			$imagePath = [];
			foreach ($files as $j => $file) {
				$imagePath[] = $imagineCacheManager->getBrowserPath(
					'/upload/' . $file->getFileType() . '/' . $file->getUniqid() . '.jpg',
					$file->getFilter()
				);
			}
			
			$object->getProduct()->setFiles($imagePath);
			
			$out[] = $object;
		}
		
		return $out;
	}
	
	protected function rowImage($entity)
	{
		
		if (!method_exists($entity,'setFiles')) {
			return $entity;
		}
		
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		
		$files = $this->get("tianos.repository.files")->findAllByEntity($entity);
		
		$imagePath = [];
		foreach ($files as $j => $file) {
			$imagePath[] = $imagineCacheManager->getBrowserPath(
				'/upload/' . $file->getFileType() . '/' . $file->getUniqid() . '.jpg',
				$file->getFilter()
			);
		}
		
		$entity->setFiles($imagePath);
		
		return $entity;
	}
	
}