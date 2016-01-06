<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController {

	public function indexAction(Request $request, Application $app)
    {
		return $app['twig']->render('private/index.html.twig');
	}
}