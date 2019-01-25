<?php

namespace CrCms\Permission\Http\Api\Resources;

use CrCms\Foundation\Resources\Resource;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Http\Request;

class RoleResource extends Resource
{
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
            'created_at' => $this->created_at->toDateTimeString() ?? '',
            'updated_at' => $this->updated_at->toDateTimeString() ?? '',
        ];
    }

    /**
     * @return PermissionResource
     */
    protected function includePermissions(): PermissionResource
    {
        return PermissionResource::collection($this->belongsToManyPermissions)->only(['title','route']);
    }
}
