<?php

/**
 * PUBLIC ROUTES
 */

$app->get('/', 'App\Controller\SecurityController::loginAction')
    ->before('App\Middleware\SecurityMiddleware::checkAnonymous');

$app->post('/', 'App\Controller\SecurityController::loginProcessAction')
    ->before('App\Middleware\SecurityMiddleware::checkAnonymous');

$app->get('/password', 'App\Controller\SecurityController::passwordAction');



/**
 * PRIVATE ROUTES
 */

$app->get('/admin', 'App\Controller\AdminController::indexAction')
    ->before('App\Middleware\SecurityMiddleware::checkAuthentication');

$app->get('/logout', 'App\Controller\SecurityController::logoutAction')
    ->before('App\Middleware\SecurityMiddleware::checkAuthentication');
