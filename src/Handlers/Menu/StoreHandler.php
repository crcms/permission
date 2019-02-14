<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Repositories\MenuRepository;

/**
 * Class StoreHandler
 * @package CrCms\Permission\Handlers\Menu
 */
class StoreHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return MenuModel
     */
    public function handle(DataProviderContract $provider): MenuModel
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        //数据整合
        $input = $provider->all();

        //过滤字段
        $guard = ['title', 'url', 'route', 'icon', 'sort', 'status', 'pid', 'remark'];

        return $repository->setGuard($guard)->create($input);
    }
}