<?php

namespace CrCms\Permission\Repositories;

use Illuminate\Support\Collection;
use CrCms\Permission\Models\RoleModel;
use CrCms\Repository\AbstractRepository;
use CrCms\Permission\Repositories\Magic\RoleMagic;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use CrCms\Permission\Repositories\Constants\CommonConstant;

class RoleRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['name', 'status', 'super', 'remark'];

    /**
     * @return RoleModel
     */
    public function newModel(): RoleModel
    {
        return new RoleModel;
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function paginate(array $data): LengthAwarePaginator
    {
        return $this->magic(new RoleMagic($data))
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * syncRoleMenus.
     *
     * @param RoleModel $role
     * @param array $menus
     * @return array
     */
    public function syncRoleMenus(RoleModel $role, array $menus): array
    {
        return $role->belongsToManyMenus()->sync($menus);
    }

    /**
     * syncRolePermissions.
     *
     * @param RoleModel $role
     * @param array $permissions
     * @return array
     */
    public function syncRolePermissions(RoleModel $role, array $permissions): array
    {
        return $role->belongsToManyPermissions()->sync($permissions);
    }

    /**
     * syncRoleFields.
     *
     * @param RoleModel $role
     * @param array $fields
     * @return array
     */
    public function syncRoleFields(RoleModel $role, array $fields): array
    {
        return $role->belongsToManyFields()->sync($fields);
    }

    /**
     * rolePermissions.
     *
     * @param RoleModel $role
     * @return Collection
     */
    public function rolePermissions(RoleModel $role): Collection
    {
        return $role->belongsToManyPermissions()->get();
    }

    /**
     * roleFields.
     *
     * @param RoleModel $role
     * @return Collection
     */
    public function roleFields(RoleModel $role): Collection
    {
        return $role->belongsToManyFields()->get();
    }

    /**
     * roleMenus.
     *
     * @param RoleModel $role
     * @return Collection
     */
    public function roleMenus(RoleModel $role): Collection
    {
        return $role->belongsToManyMenus()->get();
    }

    /**
     * containsSuperRole.
     *
     * @param Collection $roles
     * @return bool
     */
    public function containsSuperRole(Collection $roles): bool
    {
        return $roles->filter(function (RoleModel $role) {
            return $role->super === CommonConstant::SUPER_YES;
        })->isNotEmpty();
    }

    /**
     * filterNotNormalRole.
     *
     * @param Collection $roles
     * @return Collection
     */
    public function filterNotNormalRole(Collection $roles): Collection
    {
        return $roles->filter(function (RoleModel $role) {
            return $role->status === CommonConstant::STATUS_NORMAL;
        });
    }

    /**
     * @return Collection
     */
    public function allByStatusNormal(): Collection
    {
        return $this->where('status', CommonConstant::STATUS_NORMAL)
            ->get();
    }
}
