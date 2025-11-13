<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name|string|max:255'
        ]);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')->with('message', 'Permission Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $permission =Permission::findOrFail($id);

        // return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);
        
        $permission->update($validated);

        return redirect()->route('admin.permissions.index')->with('message', 'Permission Updated Successfully');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message', 'Role already assigned to permission');
        }

        $permission->assignRole($request->role);
        return back()->with('message', 'Role assigned to permission successfully');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role) ) {
            $permission->removeRole($role);
            return back()->with('message', 'Role removed from permission successfully');
        }

        return back()->with('message', 'Role not assigned to permission');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('message', 'Permission Deleted Successfully');
    }
}
