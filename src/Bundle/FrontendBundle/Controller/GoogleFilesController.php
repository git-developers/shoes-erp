<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class GoogleFilesController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function insertViewAction(Request $request): Response
    {
        $googleDriveFilesCount = $this->get('tianos.repository.google.drive.count')->getViewCount();

        foreach ($googleDriveFilesCount as $key => $gdFile) {

            $count = $gdFile['count_'];
            $fileId = $gdFile['file_id'];

            $googleDriveObject = $this->get('tianos.repository.google.drive')->find($fileId);

            if (is_null($googleDriveObject)) {
                continue;
            }

            // UPDATE VIEWS
            $countView = $googleDriveObject->getCountView();
            $googleDriveObject->setCountView($countView + $count);
            $this->persist($googleDriveObject);


            // DELETE VIEWS
            $this->get('tianos.repository.google.drive.count')->deleteViewCount($fileId);
        }

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function insertShareAction(Request $request): Response
    {
        $googleDriveFilesCount = $this->get('tianos.repository.google.drive.count')->getShareCount();

        foreach ($googleDriveFilesCount as $key => $gdFile) {

            $count = $gdFile['count_'];
            $fileId = $gdFile['file_id'];

            $googleDriveObject = $this->get('tianos.repository.google.drive')->find($fileId);

            if (is_null($googleDriveObject)) {
                continue;
            }

            // UPDATE SHARES
            $countShare = $googleDriveObject->getCountShare();
            $googleDriveObject->setCountShare($countShare + $count);
            $this->persist($googleDriveObject);


            // DELETE SHARES
            $this->get('tianos.repository.google.drive.count')->deleteShareCount($fileId);
        }

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createJsonFilesAction(Request $request): Response
    {
        $options = $request->attributes->get('_tianos');

        $vars = $options['vars'] ?? null;

        $googleDriveFiles = $this->get('tianos.repository.google.drive')->findAllNative();
        $objects = $this->getSerialize($googleDriveFiles, $vars['serialize_group_name']);

        $savePath = getcwd() . '/google-drive-files/google-drive-files.json';
        $isSaved = file_put_contents($savePath, $objects);

        return new Response();
    }
}
