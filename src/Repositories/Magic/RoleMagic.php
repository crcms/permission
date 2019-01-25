<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 17:37
 */

namespace CrCms\Permission\Repositories\Magic;

use CrCms\Repository\AbstractMagic;
use CrCms\Repository\Contracts\QueryMagic;
use CrCms\Repository\Drivers\Eloquent\QueryRelate;

class RoleMagic extends AbstractMagic implements QueryMagic
{
    /**
     * 搜索角色名称
     *
     * @param QueryRelate $query
     * @param string $name
     * @return QueryRelate
     */
    public function byName(QueryRelate $query, string $name): QueryRelate
    {
        return $query->where('name', 'like', $name.'%');
    }

    /**
     * 搜索状态
     *
     * @param QueryRelate $query
     * @param string $status
     * @return QueryRelate
     */
    public function byStatus(QueryRelate $query, string $status): QueryRelate
    {
        return $query->where('status', (int)$status);
    }
}