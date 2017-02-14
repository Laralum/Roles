<?php

namespace Laralum\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laralum_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'color'];

    /**
     * Return all the role users.
     */
    public function users()
    {
        return $this->belongsToMany('Laralum\Users\Models\User', 'laralum_role_user');
    }

    /**
     * Return all the role permissions.
     */
    public function permissions()
    {
        return $this->belongsToMany('Laralum\Permissions\Models\Permission', 'laralum_permission_role');
    }

    /**
     * Returns true if the role have the specified user.
     *
     * @param mixed $user
     */
    public function hasUser($user)
    {
        return RoleUser::where(
                ['role_id' => $this->id, 'user_id' => $user->id]
            )->first();
    }

    /**
     * Returns true if the role have the specified permission.
     *
     * @param mixed $permission
     */
    public function hasPermission($permission)
    {
        return PermissionRole::where(
                ['role_id' => $this->id, 'permission_id' => $permission->id]
            )->first();
    }

    /**
     * Adds a user into the role.
     *
     * @param mixed $user
     */
    public function addUser($user)
    {
        if( !$this->hasUser($user) ) {
            return RoleUser::create(['role_id' => $this->id, 'user_id' => $user->id]);
        }

        return false;
    }

    /**
     * Adds a permission into the role.
     *
     * @param mixed $permission
     */
    public function addPermission($permission)
    {
        if( !$this->hasPermission($permission) ) {
            return PermissionRole::create(['role_id' => $this->id, 'permission_id' => $permission->id]);
        }

        return false;
    }

    /**
     * Adds users into the role.
     *
     * @param array $users
     */
    public function addUsers($users)
    {
        foreach( $users as $user ) {
            $this->addUser($user);
        }

        return true;
    }

    /**
     * Adds permissions into the role.
     *
     * @param array $permissions
     */
    public function addPermissions($permissions)
    {
        foreach( $permissions as $permission ) {
            $this->addPermission($permission);
        }

        return true;
    }

    /**
     * Deletes the specified role user.
     *
     * @param mixed $user
     */
    public function deleteUser($user)
    {
        if( $this->hasUser($user) ) {
            return RoleUser::where(
                    ['role_id' => $this->id, 'user_id' => $user->id]
                )->first()->delete();
        }

        return false;
    }

    /**
     * Deletes the specified role permission.
     *
     * @param mixed $permission
     */
    public function deletePermission($permission)
    {
        if( $this->hasPermission($permission) ) {
            return PermissionRole::where(
                    ['role_id' => $this->id, 'permission_id' => $permission->id]
                )->first()->delete();
        }

        return false;
    }

    /**
     * Deletes the specified role users.
     *
     * @param array $users
     */
    public function deleteUsers($users)
    {
        foreach($users as $user) {
            $this->deleteUser($user);
        }

        return true;
    }

    /**
     * Deletes the specified role users.
     *
     * @param array $users
     */
    public function deletePermissions($permissions)
    {
        foreach($permissions as $permission) {
            $this->deletePermission($permission);
        }

        return true;
    }
}
