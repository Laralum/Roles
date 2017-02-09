<?php

namespace Laralum\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class permissionRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laralum_permission_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_id', 'role_id'];
}
