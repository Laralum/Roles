<?php

namespace Laralum\Roles\Traits;

use Laralum\Permissions\Traits\HasPermissions;

trait HasRolesAndPermissions
{
    use HasRoles;

    /**
    * Returns true if the role has a permission.
    *
    * @param mixed $role
    * @return bool
    */
    public function hasPermission($permission)
    {
        $permission = !is_string($permission) ?: Permission::where(['slug' => $permission])->first();

        if ($permission) {
            foreach ($this->roles as $role) {
                if ($role->hasPermission($permission)) {
                    return true;
                }
            }
        }

        return false;
    }
}
