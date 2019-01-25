<?php

namespace CrCms\Permission\Http\Api\Resources;

use CrCms\Foundation\Resources\Resource;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Http\Request;

class PermissionResource extends Resource
{
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
            'created_at' => $this->created_at->toDateTimeString() ?? '',
            'updated_at' => $this->updated_at->toDateTimeString ?? '',
        ];
    }
}
