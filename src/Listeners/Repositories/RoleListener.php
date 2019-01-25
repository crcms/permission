<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 10:33
 */

namespace CrCms\Permission\Listeners\Repositories;

use CrCms\Permission\Repositories\RoleRepository;

class RoleListener
{
    /**
     * 创建前事件监听
     *
     * @param RoleRepository $repository
     * @param array $data
     */
    public function creating(RoleRepository $repository, array $data)
    {
        $repository->addData([
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * 更新前事件监听
     *
     * @param RoleRepository $repository
     * @param array $data
     */
    public function updating(RoleRepository $repository, array $data)
    {
        $repository->addData([
                'updated_at' => time(),
            ]
        );
    }
}