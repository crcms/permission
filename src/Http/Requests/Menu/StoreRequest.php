<?php

namespace CrCms\Permission\Http\Requests\Menu;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Validation\Rule;

class StoreRequest extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:128', 'unique:menus,title'],
            'url' => ['sometimes', 'string', 'max:255'],
            'route' => ['sometimes', 'string', 'max:128'],
            'status' => ['required', 'integer', Rule::in(array_keys(CommonConstant::STATUS_LIST))],
            'sort' => ['required', 'integer'],
            'pid' => ['required', 'integer'],
            'remark' => ['sometimes', 'string', 'max:255']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => '菜单标题',
            'url' => '链接',
            'route' => '路由',
            'status' => '状态',
            'sort' => '排序',
            'pid' => '父级id',
            'remark' => '备注',
        ];
    }
}