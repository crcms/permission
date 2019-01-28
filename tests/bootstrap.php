<?php

$config = require __DIR__.'/../config/config.php';

// init app
$app = new \Illuminate\Container\Container();
\Illuminate\Container\Container::setInstance($app);
\Illuminate\Support\Facades\Facade::setFacadeApplication($app);

//alias
$app->alias('config', \Illuminate\Contracts\Config\Repository::class);
$app->alias('config', \Illuminate\Config\Repository::class);
//$app->alias('queue', \Illuminate\Queue\QueueManager::class);
//$app->alias('queue', \Illuminate\Contracts\Queue\Factory::class);
//$app->alias('queue', \Illuminate\Contracts\Queue\Monitor::class);
$app->alias('events', \Illuminate\Contracts\Events\Dispatcher::class);
$app->alias('events', \Illuminate\Events\Dispatcher::class);
//$app->alias('cache', \Illuminate\Cache\CacheManager::class);
//$app->alias('cache', \Illuminate\Contracts\Cache\Factory::class);
//$app->alias('cache.store', \Illuminate\Cache\Repository::class);
//$app->alias('cache.store',  \Illuminate\Contracts\Cache\Repository::class);
$app->alias('validator',  \Illuminate\Validation\Factory::class);
$app->alias('validator',  \Illuminate\Contracts\Validation\Factory::class);

//config
$app->singleton('config', function () use ($config) {
    return new \Illuminate\Config\Repository([
//        'app' => [
//            'locale' => 'zh-CN',
//            'fallback_locale' => 'en',
//        ],
        'permission' => $config,
        'database' => [
            'default' => 'mysql',
            'migrations' => 'permission_testing_migrations',
            'connections' => [
                'mysql' => [
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'database' => 'permissions',
                    'username' => 'homestead',
                    'password' => 'secret',
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => true,
                    'engine' => null,
                ],
            ],
        ],
//        'queue' => [
//            'default' => 'sync',
//            'connections' => [
//
//                'sync' => [
//                    'driver' => 'sync',
//                ],
//            ]
//        ],
//        'cache' => [
//
//            'default' => env('CACHE_DRIVER', 'file'),
//
//
//            'stores' => [
//
//                'array' => [
//                    'driver' => 'array',
//                ],
//
//
//                'file' => [
//                    'driver' => 'file',
//                    'path' => __DIR__.'/cache',
//                ],
//
//            ],
//
//
//            'prefix' => 'passport_testing',
//
//
//        ]
    ]);
});

//$router = Mockery::mock('Illuminate\Support\Facades\Route');
//$router->shouldReceive('namespace');
//$router->shouldReceive('register');
//$router->shouldReceive('group');
//$router = Mockery::mock('router');
//$Route = Mockery::mock('Illuminate\Support\Facades\Route');
//$Route->shouldReceive('namespace','register','group');

$app->instance('path.lang', __DIR__.'./');

function config_path($path = null)
{
    return is_null($path) ? __DIR__ : __DIR__.'/'.$path;
}

function app_path($path = null)
{
    return is_null($path) ? __DIR__ : __DIR__.'/'.$path;
}

//function resource_path($path = null)
//{
//    return is_null($path) ? __DIR__ : __DIR__.'/'.$path;
//}
function app() {
    return \Illuminate\Container\Container::getInstance();
}


//function config($key,$default = null)
//{
//    \Illuminate\Container\Container::getInstance()->make('config')->get($key,$default);
//}


//function trans($key = null, $replace = [], $locale = null)
//{
//
//    return \Illuminate\Container\Container::getInstance()->make('translator')->trans($key, $replace, $locale);
//}

$request = Mockery::mock('request');
$request->shouldReceive('all')->andReturn([]);

$app->instance('request',$request);


//service providers
$providers = [
    \Illuminate\Database\DatabaseServiceProvider::class,
//    \Illuminate\Hashing\HashServiceProvider::class,
//    \Illuminate\Queue\QueueServiceProvider::class,
    \Illuminate\Events\EventServiceProvider::class,
    \Illuminate\Filesystem\FilesystemServiceProvider::class,
    \Illuminate\Translation\TranslationServiceProvider::class,
//    \Illuminate\Bus\BusServiceProvider::class,
    \Illuminate\Cache\CacheServiceProvider::class,
    \Illuminate\Database\MigrationServiceProvider::class,
    \Illuminate\Validation\ValidationServiceProvider::class,
    \CrCms\Foundation\Transporters\DataServiceProvider::class,
    \CrCms\Repository\RepositoryServiceProvider::class,
];

$providers = array_map(function ($provider) use ($app) {
    return new $provider($app);
}, $providers);

foreach ($providers as $provider) {
    $provider->register();
}

foreach ($providers as $provider) {
    if (get_class($provider) === \CrCms\Foundation\Transporters\DataServiceProvider::class) {
        continue;
    }
    if (method_exists($provider, 'boot')) {
        $provider->boot();
    }

}

if (!$app->make('migrator')->getRepository()->repositoryExists()) {
    $app->make('migrator')->getRepository()->createRepository();
}
$app->make('migrator')->reset([__DIR__.'/../database/migrations']);
$app->make('migrator')->run(__DIR__.'/../database/migrations');

//$app->make(DatabaseSeeder::class)->run();

return $app;
