<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 17:42
 */

namespace CrCms\Permission\Http\Api\Resources;

use App\Modules\Support\Http\Api\Resources\MetaConcern;
use CrCms\Foundation\Resources\Resource;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Http\Request;

class RoleResource extends Resource
{
    use MetaConcern;

    /**
     * @var array
     */
    protected $includes = []; // 'permissions'

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => e($this->name ?? ''),
            'status' => $this->status ?? 1,
            'status_text' => e(CommonConstant::STATUS_LIST[$this->status] ?? ''),
            'super' => $this->super ?? 0,
            'super_text' => e(CommonConstant::SUPER_LIST[$this->super] ?? ''),
            'remark' => $this->remark ?? '',
            'created_at' => date('Y-m-d H:i:s', $this->created_at),
            'updated_at' => date('Y-m-d H:i:s', $this->updated_at),
        ];
    }

    /**
     * @return PermissionResource
     */
    protected function includePermissions(): PermissionResource
    {
        return PermissionResource::collection($this->belongsToManyPermissions)->only(['title','route']);
    }

    /**
     * @param $request
     * @return array
     */
    public function headings($request): array
    {
        return [
            'id' => 'ID',
            'name' => '角色名',
            'status_text' => '状态',
            'super_text' => '是否是管理员',
            'remark' => '备注',
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
                'tip'  => '角色名',
                'sort' => 20,
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'tip'  => '状态',
                'options' => CommonConstant::STATUS_LIST,
                'sort' => 10,
            ],
        ];
    }
}