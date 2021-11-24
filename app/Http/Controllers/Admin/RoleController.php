<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_permissions = Role::with('permissions')->get();
        return view('admin.role.index', compact('role_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->role]);
        $listPermissions = explode(',',  $request->permissions);
        foreach ($listPermissions as $permission) {
            $per = Permission::where('name', $permission)->first();
            //check if there is not the Repetitious permission,create new permission
            if (empty($per)) {
                $permission = Permission::create(['name' => $permission]);
            }
            $role->givePermissionTo($permission);
        }

        return redirect()->back()->with('success', 'Role add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role_permissions = Role::with('permissions')->find($role->id);
        return view('admin.role.update', compact('role', 'role_permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {

        $role->name = $request->role;
        $role->guard_name = 'web';
        $role->save();

        $listPermissions = explode(',',  $request->permissions);
        foreach ($listPermissions as $permission) {
            $per = Permission::where('name', $permission)->first();
            //check if there is not the Repetitious permission,create new permission
            if (empty($per)) {
                $permission = Permission::create(['name' => $permission]);
            }
            $role->givePermissionTo($permission);
        }
        $role->syncPermissions($listPermissions);
        return redirect()->back()->with('success', 'Role Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $users = User::Role($role->name)->get();
        foreach ($users as $user) {
            $user->permissions()->detach();
            $user->roles()->detach();
        }
        $role->delete(); // delete role
        $role->permissions()->detach(); //delete reletion roles_permissions
        return redirect()->back()->with('success', 'Role deleted Successfully');
    }
}