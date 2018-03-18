<?php
use Silex\Application;

require_once __DIR__ . './../vendor/autoload.php';

$app = new Application();

Symfony\Component\Debug\Debug::enable();
$app['debug'] = true;

$app->mount('/', new mgcom\GlobalRouter());

$app->run();