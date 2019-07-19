<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Services\Google;

use CoreBundle\Entity\User;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Twig_Environment;

class BaseGoogle extends \Twig_Extension
{

    const STATUS_SUCCESS = true;
    const STATUS_ERROR = false;
    const MY_DRIVE = 'my-drive';
    const SHARE_WITH_ME = 'shared-with-me';

    private $user;
    private $container;
    protected $clientSecretPath;

    public function __construct(Container $container, TokenStorage $tokenStorage)
    {
        $this->container = $container;
//        $this->user = $this->container->get('security.token_storage')->getToken()->getUser();
//        $this->user = $tokenStorage->getToken()->getUser();
        $this->user = $this->getUser();
        $this->clientSecretPath = $this->container->get('kernel')->getRootDir() . '/../src/Bundle/GoogleBundle/ClientSecret/';
    }

    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    /**
     * Expands the home directory alias '~' to the full path.
     * @param string $path the path to expand.
     * @return string the expanded path.
     */
    protected function expandHomeDirectory($path) {

        $homeDirectory = getenv('HOME');

        if (empty($homeDirectory)) {
            $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
        }

//        return dirname($path);
        return str_replace('~', realpath($homeDirectory), $path);
    }

    protected function getCredentialsJson() {
        return $this->clientSecretPath . 'AcessToken/access-token-' . $this->user->getUsername() . '.json';
    }

    public function createQ($field, $parents, $search)
    {

        if(!empty($search)){
            return "fullText contains '".$search."' AND trashed = false";
        }

        if (!empty($parents)) {
            return "'".$parents."' in parents AND trashed = false";
        }

        switch($field){
            case self::MY_DRIVE:
                $q = "'root' in parents AND trashed = false";
                break;
            case self::SHARE_WITH_ME:
                $q = "sharedWithMe AND trashed = false";
                break;
            default:
                $q = "'root' in parents AND trashed = false";
                break;
        }

        return $q;
    }

    public function getOrderBy($search)
    {
        if(!empty($search)){
//            return [];
            return null;
        }

//        return ['orderBy' => 'folder'];
        return 'folder';
    }

    public function createSmallText($field)
    {
        switch($field){
            case 'my-drive':
                $smallText = "my drive";
                break;
            case 'shared-with-me':
                $smallText = 'shared with me';
                break;
            default:
                $smallText = "my drive";
                break;
        }

        return $smallText;
    }



    /*


    //Redis
    public function redisGet($key)
    {
//        $redis = $this->container->get('snc_redis.default');
//        $redis->get($key);

        $cache = new FilesystemAdapter();

        // retrieve the cache item
        $numProducts = $cache->getItem($key);
        if (!$numProducts->isHit()) {
            // ... item does not exists in the cache
            return '';
        }

        // retrieve the value stored by the item
        $total = $numProducts->get();

//        echo '<pre> POLLO::';
//        print_r($total);
//        exit;


        return unserialize($total);

    }

    public function redisSet($key, $value)
    {
//        $redis = $this->container->get('snc_redis.default');
//        $redis->set($key, $value);
//        $redis->expire($key, 3600);

        // available adapters: filesystem, apcu, redis, array, doctrine cache, etc.
        $cache = new FilesystemAdapter();

        // create a new item getting it from the cache
        $numProducts = $cache->getItem($key);

        // assign a value to the item and save it
        $numProducts->set(serialize($value));
        $cache->save($numProducts);

    }

    public function redisDelete($key)
    {
        $cache = new FilesystemAdapter();
        // remove the cache item
        $cache->deleteItem($key);
    }

//    protected function redisFlushall()
//    {
//        $redis = new RedisAdapter($this->container->get('snc_redis.blogs'), 'blogs:');
//        $redis->getRedis()->flushall();
//    }

    protected function getRepository($repository, $bundleName = "BatBundle" )
    {
//        return $this->getRepository('BatOrderMerchandise');

//        $repository = $this->getOrderStatusRepository();
//        return $repository->findOneByNombre(BatOrderStatus::EJECUTADO);

//        return $this->manager->getRepository($bundleName .":" . $repository);
    }

    protected function save($entity, $flush = false)
    {
//        $this->manager->persist($entity);
//
//        if ($flush) {
//            $this->manager->flush();
//        }
    }


    */



    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }
}