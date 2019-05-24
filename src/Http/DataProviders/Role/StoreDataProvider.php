<?php

namespace CrCms\Permission\Http\DataProviders\Role;

use Illuminate\Validation\Rule;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class StoreDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:128', 'unique:roles,name'],
            'remark' => ['sometimes', 'string', 'max:255'],
            'status' => ['required', 'integer', Rule::in(array_keys(CommonConstant::STATUS_LIST))],
            //'super' => ['required', 'integer', Rule::in(array_keys(CommonConstant::SUPER_LIST))],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => '角色名称',
            'status' => '状态',
            'super' => '是否是管理员',
            'remark' => '备注',
        ];
    }
}
