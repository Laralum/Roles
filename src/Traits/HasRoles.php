<?php

namespace Laralum\Roles\Traits;

use Laralum\Roles\Models\Role;

trait HasRoles
{
    /**
    * Returns the user roles.
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'laralum_role_user');
    }

    /**
    * Returns true if the user has the role.
    *
    * @param mixed $role
    * @return bool
    */
    public function hasRole(Role $role)
    {
        $role = !is_string($role) ?: Role::where(['name' => $role])->firstOrFail();

        if ($role) {
            foreach( $this->roles as $r ) {
                if( $r->id == $role->id ) {
                    return true;
                }
            }
        }

        return false;
    }

}
