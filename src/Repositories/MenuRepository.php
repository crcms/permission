<?php

namespace CrCms\Permission\Repositories;

use Illuminate\Support\Collection;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Models\RoleModel;
use CrCms\Repository\AbstractRepository;
use CrCms\Permission\Repositories\Constants\CommonConstant;

class MenuRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['title', 'url', 'route', 'icon', 'sort', 'status', 'parent_id', 'remark'];

    /**
     * @return MenuModel
     */
    public function newModel(): MenuModel
    {
        return new MenuModel;
    }

    /**
     * descendantAndSelfById.
     *
     * @param int $id
     * @return Collection
     */
    public function descendantAndSelfById(int $id): Collection
    {
        return MenuModel::descendantsAndSelf($id);
    }

    /**
     * allToTree.
     *
     * @return Collection
     */
    public function allToTree(): Collection
    {
        return $this->all()->toTree();
    }

    /**
     * @return Collection
     */
    public function allByStatusNormal(): Collection
    {
        return $this->where('status', CommonConstant::STATUS_NORMAL)
            ->orderBy('sort', 'desc')
            ->get()->toTree();
    }

    /**
     * @param RoleModel $role
     * @return Collection
     */
    public function allByRole(RoleModel $role): Collection
    {
        return $role->belongsToManyMenus()
            ->orderBy('sort', 'desc')
            ->get()->filter(function (MenuModel $menu) {
                return $menu->status === CommonConstant::STATUS_NORMAL;
            })->toTree();
    }
}
