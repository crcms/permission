<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 11:11
 */

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\MenuRepository;

class SearchHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return array
     */
    public function handle(DataProviderContract $provider): array
    {
        /* @var MenuRepository $repository */
        $repository = app(MenuRepository::class);

        return $repository->getTreeList($provider->all());
    }
}