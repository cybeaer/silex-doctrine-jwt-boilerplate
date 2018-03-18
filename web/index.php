<?php
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;

$baseDir = __DIR__ . '/../';
$loader = require $baseDir . '/vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$app = new Application();

$app['debug'] = false;

$app->register(
    new DoctrineServiceProvider(),
    require ($baseDir.'/src/Config/db.php')
);

$app->register(
    new DoctrineOrmServiceProvider(),
    [
        'orm.proxies_dir'             => $baseDir . 'src/Entity/Proxy',
        'orm.auto_generate_proxies'   => $app['debug'],
        'orm.em.options'              => [
            'mappings' => [
                [
                    'type'                         => 'annotation',
                    'namespace'                    => 'mgcom\\Entity\\',
                    'path'                         => $baseDir. 'src/Entity',
                    'use_simple_annotation_reader' => false,
                ],
            ],
        ]
    ]);

$app->mount('/', new mgcom\GlobalRouter());

$app->run();