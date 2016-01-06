<?php

namespace App\ServiceProvider;

use PDO;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class PDOServiceProvider
 * @package App\ServiceProvider
 */

class PDOServiceProvider implements ServiceProviderInterface {

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['pdo'] = function ($app) {
            return new PDO($app['pdo.dsn'], $app['pdo.username'], $app['pdo.password'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
            ]);
        };
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}