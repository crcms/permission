<?php

namespace CrCms\Permission\Repositories\Magic;

use CrCms\Repository\AbstractMagic;
use CrCms\Repository\Contracts\QueryMagic;
use CrCms\Repository\Drivers\Eloquent\QueryRelate;

class PermissionMagic extends AbstractMagic implements QueryMagic
{
    /**
     * 搜索权限标题
     *
     * @param QueryRelate $query
     * @param string $title
     * @return QueryRelate
     */
    public function byTitle(QueryRelate $query, string $title): QueryRelate
    {
        return $query->where('title', 'like', $title.'%');
    }

    /**
     * 搜索请求方法
     *
     * @param QueryRelate $query
     * @param string $action
     * @return QueryRelate
     */
    public function byAction(QueryRelate $query, string $action): QueryRelate
    {
        return $query->where('action', 'like', $action.'%');
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