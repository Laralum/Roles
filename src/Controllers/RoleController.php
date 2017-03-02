<?php

namespace Laralum\Roles\Controllers;

use App\Http\Controllers\Controller;
use Laralum\Permissions\Models\Permission;
use Laralum\Roles\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laralum_roles::index', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('laralum_roles::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $this->validate($request, [
            'name'        => 'required|max:255',
            'color'       => 'required',
            'description' => 'required|max:500',
        ]);
        Role::create($request->all());
        return redirect()->route('laralum::roles.index')->with('success',  __('laralum_roles::general.role_added'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', Role::class);
        return view('laralum_roles::edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', Role::class);
        $this->validate($request, [
            'name'        => 'required|max:255',
            'color'       => 'required',
            'description' => 'required|max:500',
        ]);
        $role->update($request->all());
        return redirect()->route('laralum::roles.index')->with('success',  __('laralum_roles::general.role_updated', ['id' => $role->id]));
    }

    /**
     * Show / edit the role permissions.
     *
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function permissions(Role $role)
    {
        $this->authorize('manage_permissions', Role::class);
        return view('laralum_roles::permissions', ['permissions' => Permission::all(), 'role' => $role]);
    }

    /**
     * Update the role permissions.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $this->authorize('manage_permissions', Role::class);
        $permissions = Permission::all();

        foreach($permissions as $permission) {
            if( array_key_exists($permission->id, $request->all()) ) {
                $role->addPermission($permission);
            } else {
                $role->deletePermission($permission);
            }
        }

        return redirect()->route('laralum::roles.index')->with('success',  __('laralum_roles::general.role_permissions_updated', ['id' => $role->id]));
    }

    /**
     * Displays a view to confirm delete.
     *
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(Role $role)
    {
        $this->authorize('delete', Role::class);
        return view('laralum::pages.confirmation', [
            'method' => 'DELETE',
            'action' => route('laralum::roles.destroy', ['role' => $role]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $this->authorize('delete', Role::class);
        $role->deletePermissions($role->permissions);
        $role->deleteUsers($role->users);

        $role->delete();

        return redirect()->route('laralum::roles.index')->with('success', __('laralum_roles::general.role_deleted', ['id' => $role->id]));
    }
}
