<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\MenuRepository;

class DestroyHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return int
     * @throws \Exception
     */
    public function handle(DataProviderContract $provider): int
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        //判断是否含有子集数据
        $models = $repository->hasChildren($provider->get('menu'));

        if (!$models->isEmpty()) {
            throw new \Exception('含有子集菜单,不允许删除');
        }

        return $repository->delete($provider->get('menu'));
    }
}