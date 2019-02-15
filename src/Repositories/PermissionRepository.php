<?php

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Repositories\Magic\PermissionMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function allBy(array $data): LengthAwarePaginator
    {
        return $this->magic(new PermissionMagic($data))
            ->orderBy('id', 'desc')
            ->get();
    }
}
