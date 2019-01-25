<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/25
 * Time: 9:59
 */

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Repositories\Magic\FieldMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FieldRepository extends AbstractRepository
{
    /**
     * @return FieldModel
     */
    public function newModel(): FieldModel
    {
        return new FieldModel;
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function paginate(array $data): LengthAwarePaginator
    {
        return $this->magic(new FieldMagic($data))->paginate();
    }

    /**
     * @param array $data
     * @return FieldModel
     */
    public function single(array $data): FieldModel
    {
        return $this->byIntIdOrFail($data['field']);
    }
}