<?php

namespace CrCms\Permission\Repositories\Magic;

use CrCms\Repository\AbstractMagic;
use CrCms\Repository\Contracts\QueryMagic;
use CrCms\Repository\Drivers\Eloquent\QueryRelate;

class MenuMagic extends AbstractMagic implements QueryMagic
{
    /**
     * 菜单标题搜索
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
     * 状态搜索
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