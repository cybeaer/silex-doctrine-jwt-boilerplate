<?php
namespace App;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalRouter implements ControllerProviderInterface{
    public function connect(Application $app)
    {
        $controller = $app['controllers_factory'];

        $controller->get('/','App\Controller\AppController::index')->bind('baseurl');

        $app->error(function (\Exception $e, Request $request, $code) {
            return new Response('No Content', $code);
        });

        return $controller;
    }
}
