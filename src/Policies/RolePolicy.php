<?php

namespace Laralum\Roles\Policies;

use Laralum\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Filters the authoritzation.
     *
     * @param mixed $user
     * @param mixed $ability
     */
    public function before($user, $ability)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }
    }

    /**
     * Determine if the current user can access roles module.
     *
     * @param  mixed $user
     * @return bool
     */
    public function access($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::roles.access');
    }


    /**
     * Determine if the current user can create roles.
     *
     * @param  mixed  $user
     * @return bool
     */
    public function create($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::roles.create');
    }

    /**
     * Determine if the current user can update roles.
     *
     * @param  mixed $user
     * @return bool
     */
    public function update($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::roles.update');
    }

    /**
     * Determine if the current user can manage permissions from roles.
     *
     * @param  mixed $user
     * @return bool
     */
    public function manage_permissions($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::roles.permissions');
    }
    
    /**
     * Determine if the current user can delete roles.
     *
     * @param  mixed $user
     * @return bool
     */
    public function delete($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::roles.delete');
    }
}
