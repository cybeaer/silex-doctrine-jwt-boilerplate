<?php
use Silex\Application;

if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR']) ||
    !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')))
{
    header('HTTP/1.0 403 Forbidden');
    exit('403 Forbidden.');
}

$baseDir = __DIR__ . '/../';
$loader = require $baseDir . '/vendor/autoload.php';

$app = new Application();

Symfony\Component\Debug\Debug::enable();
$app['debug'] = true;

require $baseDir.'src/Config/app.php';