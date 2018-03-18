<?php
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => require 'db.php'
));

$app->register(new DoctrineORMServiceProvider(), array(
    'db.orm.class_path'            => __DIR__.'/../../vendor/doctrine/orm/lib',
    'db.orm.proxies_dir'           => __DIR__.'/../../var/cache/doctrine/Proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.auto_generate_proxies' => true,
    'db.orm.entities'              => array(array(
        'type'      => 'annotation',
        'path'      => __DIR__.'/../Entity',
        'namespace' => 'Entity',
    )),
));

$app->mount('/', new mgcom\GlobalRouter());

return $app;