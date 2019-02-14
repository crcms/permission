<?php

namespace CrCms\Permission\Models\Traits;

use CrCms\Permission\Models\RoleModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserRoleRelationTrait
{
    /**
     * @return BelongsToMany
     */
    public function belongsToManyRoles(): BelongsToMany
    {
        return $this->belongsToMany(RoleModel::class, 'user_roles', 'user_id', 'role_id');
    }
}