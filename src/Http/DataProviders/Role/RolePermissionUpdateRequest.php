<?php

namespace CrCms\Permission\Http\DataProviders\Role;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class RolePermissionUpdateRequest extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:roles,id'],
            'permission' => ['required', 'array', 'exists:permissions,id'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => '角色id',
            'permission' => '权限id',
        ];
    }
}
