<?php

Route::group([
        'middleware' => [
            'web', 'laralum.base', 'laralum.auth',
            'can:access,Laralum\Roles\Models\Role',
        ],
        'prefix'    => config('laralum.settings.base_url'),
        'namespace' => 'Laralum\Roles\Controllers',
        'as'        => 'laralum::',
    ], function () {
        // First the suplementor, then the resource
        // https://laravel.com/docs/5.4/controllers#resource-controllers
        Route::get('roles/{role}/permissions', 'RoleController@permissions')->name('roles.permissions');
        Route::post('roles/{role}/permissions', 'RoleController@updatePermissions')->name('roles.permissions.update');
        Route::get('roles/{role}/delete', 'RoleController@confirmDelete')->name('roles.destroy.confirm');
        Route::resource('roles', 'RoleController', ['except' => ['show']]);
    });
