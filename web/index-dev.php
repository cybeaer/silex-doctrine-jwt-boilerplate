<?php
use Silex\Application;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR']) ||
    !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')))
{
    header('HTTP/1.0 403 Forbidden');
    exit('403 Forbidden.');
}

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