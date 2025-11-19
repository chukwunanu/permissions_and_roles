<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role already assigned to permission');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned to permission successfully');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role) ) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed from permission successfully');
        }

        return back()->with('message', 'Role not assigned to permission successfully');
    }

    public function givePermission(Request $request, User $user)
    {
        if($user->hasPermissionTo($request->permission))
        {
            return redirect()->back()->with('message', 'Permission already exists!');
        }

        $user->givePermissionTo($request->permission);
         return redirect()->back()->with('message', 'Permission Added Successfully!');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if($user->hasPermissionTo($permission))
        {
            $user->revokePermissionTo($permission);
            return redirect()->back()->with('message', 'Permission revoked Successfully');
        }

        return redirect()->back()->with('message', 'Permission does not exist');
    }

    public function destroy(User $user)
    {
        if(Auth::id() ==$user->id)
        {
            return back()->with('message', 'You cannot delete yourself');
        }
        if($user->hasRole('admin'))
        {
            return back()->with('message', 'You cannot delete an admin user');
        }
        $user->delete();

        return back()->with('message', 'User deleted successfully');
    }
}
