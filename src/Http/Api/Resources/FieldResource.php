<?php

namespace CrCms\Permission\Http\Api\Resources;

use App\Modules\Support\Http\Api\Resources\MetaConcern;
use CrCms\Foundation\Resources\Resource;
use Illuminate\Http\Request;

class FieldResource extends Resource
{
    use MetaConcern;

    /**
     * @var array
     */
    protected $includes = [];

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'table_name' => e($this->table_name ?? ''),
            'field' => e($this->field ?? ''),
            'name' => e($this->name ?? ''),
            'created_at' => $this->created_at->toDateTimeString() ?? '',
            'updated_at' => $this->updated_at->toDateTimeString() ?? '',
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function headings($request): array
    {
        return [
            'id' => 'ID',
            'table_name' => '表名',
            'field' => '字段键',
            'name' => '字段名',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function condition($request): array
    {
        return [
            [
                'name' => 'name',
                'type' => 'text',
                'tip'  => '字段名',
                'sort' => 30,
            ],
            [
                'name' => 'field',
                'type' => 'text',
                'tip'  => '字段值',
                'sort' => 20,
            ],
            [
                'name' => 'table_name',
                'type' => 'text',
                'tip'  => '字段值',
                'sort' => 10,
            ],
        ];
    }
}