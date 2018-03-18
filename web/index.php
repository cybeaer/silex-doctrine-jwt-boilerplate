<?php
require './../vendor/autoload.php';
ini_set('display_errors', 0);
$app = require './../src/Config/app.php';

$app['debug'] = false;

$app->run();