<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 14:11
 */

namespace CrCms\Permission\Tests;


use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Menu\ListHandler;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Events\EventServiceProvider;
use PHPUnit\Framework\TestCase;


class ListHandlerTest extends TestCase
{

    public function testList()
    {
        //$app = \Mockery::mock(Application::class);
        $app = new Container();
        $app->singleton('config', function () {
            return new Repository([
                    'database' => [


                        'default' => 'mysql',


                        'connections' => [


                            'mysql' => [
                                'driver' => 'mysql',
                                'host' => '127.0.0.1',
                                'port' => '3306',
                                'database' => 'forge',
                                'username' => 'forge',
                                'password' => '',

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




        $provider = new EventServiceProvider($app);
        $provider->register();

        $events = \Mockery::mock('Illuminate\Contracts\Events\Dispatcher');
        $events->shouldNotReceive('setEventDispatcher')->andReturn();

        $app->alias('events',$events);


        $provider = new DatabaseServiceProvider($app);
        $provider->register();
        $provider->boot();


        $handler = new ListHandler();

        $result = $handler->handle(new DataProvider([
            'page' => 1,
        ]));

        var_dump($result);


    }

}