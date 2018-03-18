<?php
use Silex\Application;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

$baseDir = __DIR__ . '/../';
$loader = require $baseDir . '/vendor/autoload.php';

$app = new Application();

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
$app->register(
    new DoctrineServiceProvider(),
    [
        'db.options' => [
            'driver'        => 'pdo_mysql',
            'host'          => 'localhost',
            'dbname'        => 'sample',
            'user'          => 'root',
            'password'      => 'admin',
            'charset'       => 'utf8',
            'driverOptions' => [
                1002 => 'SET NAMES utf8',
            ],
        ],
    ]
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

Symfony\Component\Debug\Debug::enable();
$app['debug'] = true;

$app->mount('/', new mgcom\GlobalRouter());

$app->run();