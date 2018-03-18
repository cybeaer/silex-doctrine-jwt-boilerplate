<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\ORMException;

$loader = require './vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$config = new Configuration();
$driverImpl = $config->newDefaultAnnotationDriver(array(
    __DIR__.'/src',
));
$config->setMetadataDriverImpl($driverImpl);
$config->setProxyDir( __DIR__.'/src/Entity/Proxy');
$config->setProxyNamespace('Proxies');

try {
    $entityManager = EntityManager::create(
        require (__DIR__.'/src/Config/db.php'),
        $config
    );
} catch (ORMException $e ){
    print_r($e->getMessage());
}

return ConsoleRunner::createHelperSet($entityManager);
