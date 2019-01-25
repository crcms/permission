<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 14:34
 */

$app = new \Illuminate\Container\Container();
\Illuminate\Container\Container::setInstance($app);

$app->alias('config',\Illuminate\Contracts\Config\Repository::class);
$app->alias('config',\Illuminate\Config\Repository::class);

$app->singleton('config', function() {

    return new \Illuminate\Config\Repository([
        'database' => [

            'default' => 'mysql',
            'connections' => [
                'mysql' => [
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'database' => 'permission',
                    'username' => 'homestead',
                    'password' => 'secret',

                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'strict' => true,
                    'engine' => null,
                ],
            ]
        ]
    ]);
});

$event = new \Illuminate\Events\EventServiceProvider($app);
$event->register();

$database = new \Illuminate\Database\DatabaseServiceProvider($app);
$database->register();
$database->boot();

//$hash = new \Illuminate\Hashing\HashServiceProvider($app);
//$hash->register();

//\Illuminate\Support\Facades\Facade::setFacadeApplication($app);

return $app;


