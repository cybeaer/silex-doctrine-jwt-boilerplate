<?php
require './../vendor/autoload.php';

$app = require './../src/Config/app.php';

$app['debug'] = false;

$app->run();