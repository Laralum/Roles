<?php

namespace Laralum\Roles\Traits;

use Laralum\Permissions\Models\Permission;

trait HasRolesAndPermissions
{
    use HasRoles;

    /**
     * Returns true if the role has a permission.
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function hasPermission($permission, $bypassIfSuperAdmin = false)
    {
        $permission = !is_string($permission) ?: Permission::where(['slug' => $permission])->first();
        
        if ($bypassIfSuperAdmin && $this->superAdmin()) {
            return true;
        }
        
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
