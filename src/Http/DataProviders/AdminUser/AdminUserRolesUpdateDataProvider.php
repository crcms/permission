<?php

namespace CrCms\Permission\Http\DataProviders\AdminUser;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class AdminUserRolesUpdateDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'role_id' => ['required', 'array', 'exists:roles,id']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => '用户id',
            'role_id' => '角色id',
        ];
    }
}