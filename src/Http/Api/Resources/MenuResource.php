<?php

namespace CrCms\Permission\Http\Api\Resources;

use CrCms\Foundation\Resources\Resource;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Http\Request;

class MenuResource extends Resource
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
            'url' => e($this->url ?? ''),
            'route' => e($this->route ?? ''),
            'status' => e($this->status ?? ''),
            'status_text' => e(CommonConstant::STATUS_LIST[$this->status] ?? ''),
            'remark' => e($this->remark ?? ''),
            'sort' => $this->sort ?? 0,
            'pid' => $this->pid ?? 0,
            'created_at' => $this->created_at->toDateTimeString() ?? '',
            'updated_at' => $this->updated_at->toDateTimeString() ?? '',
        ];
    }
}
