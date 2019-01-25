<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 11:34
 */

namespace CrCms\Permission\Handlers\Permission;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\PermissionRepository;

class DestroyHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return int
     */
    public function handle(DataProviderContract $provider): int
    {
        /* @var PermissionRepository $repository */
        $repository = app(PermissionRepository::class);

        return $repository->delete($provider->get('permission'));
    }
}