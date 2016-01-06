<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application([
	'debug' => true
]);

$app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__ . '/../views',
]);

$app->register(new Silex\Provider\SessionServiceProvider);

$app->register(new App\ServiceProvider\PDOServiceProvider, [
    'pdo.dsn' => 'mysql:dbname=adv;host=127.0.0.1',
    'pdo.username' => 'root',
    'pdo.password' => ''
]);

require_once __DIR__ . '/../app/routes.php';

$app->run();