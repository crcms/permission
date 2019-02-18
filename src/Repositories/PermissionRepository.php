<?php

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Repositories\Magic\PermissionMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PermissionRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['title', 'route', 'action', 'remark', 'status'];

    /**
     * @return PermissionModel
     */
    public function newModel(): PermissionModel
    {
        return new PermissionModel;
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function allBy(array $data)
    {
        return $this->magic(new PermissionMagic($data))
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @return Collection
     */
    public function allByStatusNormal(): Collection
    {
        return $this->where('status',CommonConstant::STATUS_NORMAL)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param RoleModel $role
     * @return Collection
     */
    public function allByRole(RoleModel $role): Collection
    {
        return $role->belongsToManyPermissions()->get()->filter(function (PermissionModel $perimission) {
            return $perimission->status === CommonConstant::STATUS_NORMAL;
        });
    }
}
