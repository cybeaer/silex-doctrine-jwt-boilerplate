<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\ORMException;

// replace with file to your own project bootstrap
require_once './vendor/autoload.php';

$config = new Configuration();
$driverImpl = $config->newDefaultAnnotationDriver(array(
    __DIR__.'/src',
));
$config->setMetadataDriverImpl($driverImpl);
//$config->setProxyDir($app['orm.proxies_dir']);
$config->setProxyDir( __DIR__.'/src/Entity/Proxy');
$config->setProxyNamespace('Proxies');

try {
    $entityManager = EntityManager::create(
        [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'sample',
            'user' => 'root',
            'password' => 'admin',
            'charset' => 'utf8',
            'driverOptions' => [
                1002 => 'SET NAMES utf8',
            ],
        ],
        $config
    );
} catch (ORMException $e ){
    print_r($e->getMessage());
}

return ConsoleRunner::createHelperSet($entityManager);
