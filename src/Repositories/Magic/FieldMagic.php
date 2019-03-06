<?php

namespace CrCms\Permission\Repositories\Magic;

use CrCms\Repository\AbstractMagic;
use CrCms\Repository\Contracts\QueryMagic;
use CrCms\Repository\Drivers\Eloquent\QueryRelate;

class FieldMagic extends AbstractMagic implements QueryMagic
{
    /**
     * 搜索字段名称.
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
     * 搜索字段.
     *
     * @param QueryRelate $query
     * @param string $fieldKey
     * @return QueryRelate
     */
    public function byField(QueryRelate $query, string $fieldKey): QueryRelate
    {
        return $query->where('field_key', 'like', $fieldKey.'%');
    }

    /**
     * 搜索字段表名.
     *
     * @param QueryRelate $query
     * @param string $tableName
     * @return QueryRelate
     */
    public function byTableName(QueryRelate $query, string $tableName): QueryRelate
    {
        return $query->where('table_name', 'like', $tableName.'%');
    }
}
