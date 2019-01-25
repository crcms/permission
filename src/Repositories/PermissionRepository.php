<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 11:22
 */

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Repositories\Magic\PermissionMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionRepository extends AbstractRepository
{
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
    public function paginate(array $data): LengthAwarePaginator
    {
        return $this->magic(new PermissionMagic($data))
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * @param array $data
     * @return PermissionModel
     */
    public function single(array $data): PermissionModel
    {
        return $this->byIntIdOrFail($data['permission']);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->newModel()->get();
    }
}