<?php

namespace Laralum\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laralum_role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'user_id'];
}
