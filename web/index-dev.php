<?php
if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR']) ||
    !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')))
{
    header('HTTP/1.0 403 Forbidden');
    exit('403 Forbidden.');
}

require './../vendor/autoload.php';

$app = require './../src/Config/app.php';

Symfony\Component\Debug\Debug::enable();
$app['debug'] = true;

$app->run();