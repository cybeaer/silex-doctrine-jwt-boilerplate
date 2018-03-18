<?php
use Silex\Application;

$baseDir = __DIR__ . '/../';
$loader = require $baseDir . '/vendor/autoload.php';

$app = new Application();

$app['debug'] = false;

require $baseDir.'src/Config/app.php';