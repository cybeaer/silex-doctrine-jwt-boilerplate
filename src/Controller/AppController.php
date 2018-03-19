<?php
namespace App\Controller {

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

    class AppController
    {
        public function index(Request $req, Application $app)
        {
            return new Response('forbidden', 403);
        }
    }
}
