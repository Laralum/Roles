<?php

namespace Laralum\Roles;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Laralum\Roles\Models\Role;
use Laralum\Roles\Policies\RolePolicy;

use Laralum\Permissions\PermissionsChecker;


class RolesServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
    ];

    /**
     * The mandatory permissions for the module.
     *
     * @var array
     */
    protected $permissions = [
        [
            'name' => 'Roles Access',
            'slug' => 'laralum::roles.access',
            'desc' => "Grants access to laralum/roles module",
        ],
        [
            'name' => 'Create Roles',
            'slug' => 'laralum::roles.create',
            'desc' => "Allows creating roles",
        ],
        [
            'name' => 'Update Roles',
            'slug' => 'laralum::roles.update',
            'desc' => "Allows updating roles",
        ],
        [
            'name' => 'View Roles',
            'slug' => 'laralum::roles.view',
            'desc' => "Allows previewing roles",
        ],
        [
            'name' => 'Manage Role Permissions',
            'slug' => 'laralum::roles.permissions',
            'desc' => "Allows mange permissions of roles",
        ],
        [
            'name' => 'Delete Roles',
            'slug' => 'laralum::roles.delete',
            'desc' => "Allows delete roles",
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadViewsFrom(__DIR__.'/Views', 'laralum_roles');

        $this->loadTranslationsFrom(__DIR__.'/Translations', 'laralum_roles');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    /**
     * I cheated this comes from the AuthServiceProvider extended by the App\Providers\AuthServiceProvider
     *
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
    
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
