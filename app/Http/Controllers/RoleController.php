<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name|string|max:255'
        ]);

        Role::create($validated);
        
        return redirect()->route('admin.roles.index')->with('message', 'Role created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' .$id
        ]);

        $role =Role::findOrFail($id);
        $role->update($validated);

        return redirect()->route('admin.roles.index')->with('message', 'Role Updated Successfully!');
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission))
        {
            return redirect()->route('admin.roles.edit', $role)->with('message', 'Permission already exists!');
        }

        $role->givePermissionTo($request->permission);
         return redirect()->route('admin.roles.edit', $role)->with('message', 'Permission Added Successfully!');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission))
        {
            $role->revokePermissionTo($permission);
            return redirect()->route('admin.roles.edit', $role)->with('message', 'Permission revoked Successfully');
        }

        return redirect()->route('admin.roles.edit', $role)->with('message', 'Permission does not exist');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('message', 'Role Deleted Successfully!');
    }
}
