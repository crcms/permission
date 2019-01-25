<?php

namespace CrCms\Permission\Http\Api\Resources;

use CrCms\Foundation\Resources\Resource;
use Illuminate\Http\Request;

class FieldResource extends Resource
{
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
}
