<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RoleModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @return BelongsToMany
     */
    public function belongsToManyPermissions(): BelongsToMany
    {
        return $this->belongsToMany(PermissionModel::class, 'role_permissions', 'role_id', 'permission_id');
    }

    /**
     * @return BelongsToMany
     */
    public function belongsToManyMenus(): BelongsToMany
    {
        return $this->belongsToMany(MenuModel::class, 'role_menus', 'role_id', 'menu_id');
    }

    /**
     * @return BelongsToMany
     */
    public function belongsToManyFields(): BelongsToMany
    {
        return $this->belongsToMany(FieldModel::class, 'role_fields', 'role_id', 'field_id');
    }
}
