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
        $this->doValidation($request);

        Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
        ]);
        return redirect()->route('laralum::roles.index')->with('success','Permission added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
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
        $this->doValidation($request, $role->id);

        $role->update($request->all());

        return redirect()->route('laralum::roles.index')->with('success','Role edited!');
    }

    /**
     * Show / edit the role permissions.
     *
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function permissions(Role $role)
    {
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
        $permissions = Permission::all();

        foreach($permissions as $permission) {
            if( array_key_exists($permission->id, $request->all()) ) {
                $role->addPermission($permission);
            } else {
                $role->deletePermission($permission);
            }
        }

        return redirect()->route('laralum::roles.index')->with('success', 'The role permissions have been updated');
    }

    /**
     * Displays a view to confirm delete.
     *
     * @param \Laralum\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(Role $role)
    {
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
        $role->deletePermissions($role->permissions);
        $role->deleteUsers($role->users);

        $role->delete();

        return redirect()->route('laralum::roles.index')->with('success','Role deleted!');
    }

    /**
     * Validate form of resource
     *
     * @param \Illuminate\Http\Request $request
     **/
    private function doValidation($request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'color' => 'required',
        ]);
    }
}
