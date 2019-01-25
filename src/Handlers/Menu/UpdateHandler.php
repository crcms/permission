<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 9:44
 */

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Repositories\MenuRepository;

class UpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return MenuModel
     */
    public function handle(DataProviderContract $provider): MenuModel
    {
        /* @var MenuRepository $repository */
        $repository = app(MenuRepository::class);

        //整合数据
        $input = $provider->all();

        //过滤字段
        $guard = ['title', 'url', 'route', 'sort', 'status', 'pid', 'remark'];

        return $repository->setGuard($guard)->update($input, $provider->get('menu'));
    }
}