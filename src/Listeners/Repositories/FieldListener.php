<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/25
 * Time: 10:46
 */

namespace CrCms\Permission\Listeners\Repositories;

use CrCms\Permission\Repositories\FieldRepository;

class FieldListener
{
    /**
     * 创建前事件监听
     *
     * @param FieldRepository $repository
     * @param array $data
     */
    public function creating(FieldRepository $repository, array $data)
    {
        $repository->addData([
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * 更新前事件监听
     *
     * @param FieldRepository $repository
     * @param array $data
     */
    public function updating(FieldRepository $repository, array $data)
    {
        $repository->addData([
                'updated_at' => time(),
            ]
        );
    }
}