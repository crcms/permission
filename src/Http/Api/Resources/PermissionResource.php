<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 11:47
 */

namespace CrCms\Permission\Http\Api\Resources;

use App\Modules\Support\Http\Api\Resources\MetaConcern;
use CrCms\Foundation\Resources\Resource;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Http\Request;

class PermissionResource extends Resource
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
            'route' => e($this->route ?? ''),
            'action' => e($this->action ?? ''),
            'status' => $this->status ?? 1,
            'status_text' => e(CommonConstant::STATUS_LIST[$this->status] ?? ''),
            'remark' => e($this->remark ?? ''),
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
            'title' => '权限标题',
            'route' => '权限路由',
            'action' => '请求方法',
            'status_text' => '状态',
            'remark' => '备注',
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
                'tip'  => '权限标题',
                'sort' => 30
            ],
            [
                'name' => 'action',
                'type' => 'text',
                'tip'  => '请求方法',
                'sort' => 20
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'tip'  => '状态',
                'options' => CommonConstant::STATUS_LIST,
                'sort' => 10
            ],
        ];
    }
}