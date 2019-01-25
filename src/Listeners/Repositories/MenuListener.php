<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/22
 * Time: 18:10
 */

namespace CrCms\Permission\Listeners\Repositories;

use CrCms\Permission\Repositories\MenuRepository;

class MenuListener
{
    /**
     * 创建前事件监听
     *
     * @param MenuRepository $repository
     * @param array $data
     */
    public function creating(MenuRepository $repository, array $data)
    {
        $repository->addData([
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * 更新前事件监听
     *
     * @param MenuRepository $repository
     * @param array $data
     */
    public function updating(MenuRepository $repository, array $data)
    {
        $repository->addData([
                'updated_at' => time(),
            ]
        );
    }
}