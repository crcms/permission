<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 8:56
 */

namespace CrCms\Permission\Http\Api\Resources;

use App\Modules\Support\Http\Api\Resources\MetaConcern;
use CrCms\Foundation\Resources\Resource;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Http\Request;

class MenuResource extends Resource
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
            'title' => e($this->title ?? ''),
            'url' => e($this->url ?? ''),
            'route' => e($this->route ?? ''),
            'status' => e($this->status ?? ''),
            'status_text' => e(CommonConstant::STATUS_LIST[$this->status] ?? ''),
            'remark' => e($this->remark ?? ''),
            'sort' => $this->sort ?? 0,
            'pid' => $this->pid ?? 0,
            'created_at' => date('Y-m-d H:i:s',$this->created_at),
            'updated_at' => date('Y-m-d H:i:s',$this->updated_at),
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
            'title' => '菜单标题',
            'url' => '链接',
            'route' => '路由',
            'status_text' => '状态',
            'remark' => '备注',
            'sort' => '排序',
            'pid' => '父级id',
            'created_at' => '创建时间',
            'updated_at' => '更新时间'
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
                'name' => 'title',
                'type' => 'text',
                'tip'  => '菜单标题',
                'sort' => 20
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'tip'  => '状态',
                'options' => CommonConstant::STATUS_LIST,
                'sort' => 10
            ]
        ];
    }
}