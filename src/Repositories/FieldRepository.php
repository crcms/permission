<?php

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\FieldModel;
use CrCms\Repository\AbstractRepository;
use CrCms\Permission\Repositories\Magic\FieldMagic;
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
}
