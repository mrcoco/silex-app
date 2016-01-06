<?php

namespace App\Middleware;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class SecurityMiddleware
 * @package App\Middleware
 */

class SecurityMiddleware {

    /**
     * @param Request $request
     * @param Application $app
     * @return RedirectResponse
     */
	public function checkAuthentication(Request $request, Application $app)
    {
        if($app['session']->get('logged') != true)
		    return new RedirectResponse('/');
	}

    /**
     * @param Request $request
     * @param Application $app
     * @return RedirectResponse
     */
    public function checkAnonymous(Request $request, Application $app)
    {
        if($app['session']->get('logged') == true)
            return new RedirectResponse('/admin');
    }
}