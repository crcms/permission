<?php

namespace CrCms\Permission\Http\DataProviders\Menu;

use Illuminate\Validation\Rule;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class UpdateDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:128'],
            'url' => ['sometimes', 'max:255'],
            'route' => ['sometimes', 'max:128'],
            'icon' => ['sometimes', 'max:255'],
            'status' => ['required', 'integer', Rule::in(array_keys(CommonConstant::STATUS_LIST))],
            'sort' => ['required', 'integer'],
            'parent_id' => ['required', 'nullable', 'integer', function ($attribute, $value, $fail) {
                if ((int) $value === (int) $this->get('menu')) {
                    throw new \InvalidArgumentException('父级id不能为本身');
                }
            },
            ],
            'remark' => ['sometimes', 'max:255'],
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
            'icon' => '菜单',
            'status' => '状态',
            'sort' => '排序',
            'parent_id' => '父级id',
            'remark' => '备注',
        ];
    }
}
