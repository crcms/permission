<?php

namespace CrCms\Permission\Commands;

use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Repositories\PermissionRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GetRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all routes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取所有api路由
        $routes = $this->getAllApiRoutes();

        //路由入库
        $this->routeUpdate($routes);
    }

    /**
     * 获取所有路由
     *
     * @return array
     */
    protected function getAllApiRoutes()
    {
        $routes = Route::getRoutes();

        $data = [];

        foreach ($routes as $key => $val) {
            $data[$key]['route'] = $val->getName();
            $data[$key]['uri'] = $val->uri;
            $data[$key]['method'] = $val->methods[0];
        }

        return $data;
    }

    /**
     * 路由入库
     *
     * @param array $routes
     */
    protected function routeUpdate(array $routes)
    {
        //判断permission中路由是否存在
        /* @var PermissionRepository $repository*/
        $repository = app(PermissionRepository::class);
        $permissions = $repository->all();

        $data = [];
        $guard = ['route', 'action', 'status', 'tag', 'created_at', 'updated_at'];
        if ($permissions->isEmpty()) {
            foreach ($routes as $key => $val) {
                $data['route'] = $val['route'];
                $data['action'] = $val['method'];
                $data['status'] = CommonConstant::STATUS_NORMAL;
                $data['tags'] = explode('.',$val['route'])[0];
                $repository->setGuard($guard)->create($data);
            }
        } else {
            //获取权限表的路由名称
            $routeName = [];
            foreach ($permissions as $k => $v) {
                $routeName[] = $v->route;
            }

            foreach ($routes as $key => $val) {
                //路由中是否含有未入库的路由，有跳过循环
                if (in_array($val['route'], $routeName)) {
                    continue;
                }

                $data['route'] = $val['route'];
                $data['action'] = $val['method'];
                $data['status'] = CommonConstant::STATUS_NORMAL;
                $data['tags'] = explode('.',$val['route'])[0];
                $repository->setGuard($guard)->create($data);
            }
        }
    }
}
