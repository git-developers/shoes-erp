<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Services\Google;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;
use Bundle\GoogleBundle\Services\Google\BaseGoogle;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class GoogleService extends BaseGoogle
{

    /** @var ObjectManager  */
    private $manager;
    private $container;
    private $twig;
    private $env;
    const DEV = 'dev';
    const PROD = 'prod';

    public function __construct(ObjectManager $manager, Container $container, \Twig_Environment $twig, $env, TokenStorage $tokenStorage)
    {
        $this->manager = $manager;
        $this->container = $container;
        $this->twig = $twig;
        $this->env = $env;

        parent::__construct($container, $tokenStorage);

    }

    public function getAuthUrl()
    {
        $authUrl = $this->createAuthUrl();

        if(!empty($authUrl)){

            return [
                'status' => self::STATUS_ERROR,
                'auth_url' => $authUrl
            ];
        }

        return [
            'status' => self::STATUS_SUCCESS,
        ];
    }

    public function createAuthUrl()
    {

        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());

        if (!file_exists($credentialsPath)) {

            // Request authorization from the user.
            $client = $this->getClient();

            return $client->createAuthUrl();
        }

        return;
    }

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    public function getClient()
    {
        $scopes = implode(' ', [
                \Google_Service_Drive::DRIVE,
                \Google_Service_Drive::DRIVE_FILE,
                \Google_Service_Drive::DRIVE_PHOTOS_READONLY,
            ]
        );

        if ($this->env == self::DEV) {
            $authConfig = $this->clientSecretPath . 'client_secret_DEV.json.twig';
        } elseif ($this->env == self::PROD) {
            $authConfig = $this->clientSecretPath . 'client_secret_PROD.json.twig';
        }

        $client = new \Google_Client();
        $client->setApplicationName('Tianos Drive');
        $client->setScopes($scopes);
        $client->setAuthConfig($authConfig);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());

        if(file_exists($credentialsPath)) {

            $accessToken = file_get_contents($credentialsPath);
            $client->setAccessToken($accessToken);

            // Refresh the token if it's expired.
            if ($client->isAccessTokenExpired()) {

//                echo '<pre> POLLO:: ';
//                print_r('getRefreshToken:: ' . $client->getRefreshToken());
//                exit;

//                return null;
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());




                file_put_contents($credentialsPath, json_encode($client->getAccessToken()));

            }
        }

        return $client;
    }

    public function storeCredentials($authCode)
    {
        $client = $this->getClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());

        $status = isset($accessToken['error']) ? $accessToken['error'] : '';

        if($status == 'invalid_grant'){
            return self::STATUS_ERROR;
        }

        // Store the credentials to disk.
        if(!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0777, true);
        }

        file_put_contents($credentialsPath, json_encode($accessToken));

        return self::STATUS_SUCCESS;

    }

    public function revokeToken()
    {
        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());
        if(file_exists($credentialsPath)) {
            unlink($credentialsPath);
        }
    }

//    public function clientSecret()
//    {
//        return $this->twig->render(
//            'BackendBundle:Twig/Googledrive:client_secret.json.twig',
//            [
//                'test' => '',
//            ]
//        );
//    }

    public function getGoogleFiles($field, $parents, $search, $pageToken)
    {
        // Get the API client and construct the service object.
        $client = $this->getClient();
        $service = new \Google_Service_Drive($client);

        // Print the names and IDs for up to 10 files.
        $optParams = [
            'pageSize' => 100,
            'corpus' => 'user',
            'pageToken' => $pageToken,
            'fields' => 'nextPageToken, files(id, name, mimeType, size, iconLink, parents)',
            'q' => $this->createQ($field, $parents, $search),
            'orderBy' => $this->getOrderBy($search),
        ];

//        $optParams = array_merge($optParams, $this->getOrderBy());

        return $service->files->listFiles($optParams);
    }


}