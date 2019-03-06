<?php

namespace CrCms\Permission\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface UserRoleRelationContract
{
    public function belongsToManyRoles(): BelongsToMany;
}
