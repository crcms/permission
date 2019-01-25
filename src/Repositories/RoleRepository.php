<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 17:34
 */

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Magic\RoleMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleRepository extends AbstractRepository
{
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
     * @param array $data
     * @return RoleModel
     */
    public function single(array $data): RoleModel
    {
        return $this->byIntIdOrFail($data['role']);
    }
}