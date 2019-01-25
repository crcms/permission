<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 11:44
 */

namespace CrCms\Permission\Listeners\Repositories;

use CrCms\Permission\Repositories\PermissionRepository;

class PermissionListener
{
    /**
     * 创建前事件监听
     *
     * @param PermissionRepository $repository
     * @param array $data
     */
    public function creating(PermissionRepository $repository, array $data)
    {
        $repository->addData([
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * 更新前事件监听
     *
     * @param PermissionRepository $repository
     * @param array $data
     */
    public function updating(PermissionRepository $repository, array $data)
    {
        $repository->addData([
                'updated_at' => time(),
            ]
        );
    }
}