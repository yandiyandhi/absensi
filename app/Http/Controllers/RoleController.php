<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        return view('role.createRole');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => Str::lower($request->role_name),
        ]);

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role, $id)
    {
        $role = Role::findOrFail($id);
        return view('role.editRole', compact('role'));
    }

    public function update(Request $request, $role)
    {
        try {
            $request->validate([
                'role_name' => 'required|string|max:255',
            ]);

            DB::table('roles')->where('id', $role)->update([
                'name' => $request->role_name,
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Role updated successfully.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Failed to update role: ' . $th->getMessage());
        }
    }

    public function assignPermission(Request $request, Role $role)
    {
        try {
            $request->validate([
                'permission_name' => 'required|exists:permissions,name',
                'checked' => 'required|boolean',
            ]);

            if ($request->checked == 1) {
                $role->givePermissionTo($request->permission_name);
            } else {
                $role->revokePermissionTo($request->permission_name);
            }

            return response()->json(['success' => $role]);
        } catch (Exception $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function roleUser($user)
    {
        $data = User::where('uuid', $user)->first();
        $roles = DB::table('roles')->orderBy('name')->get();
        return view('users.addRole', compact('data', 'roles'));
    }

    public function permissions(Role $role)
    {
        $permissions = DB::table('permissions')->orderBy('name')->get();
        return view('role.roleHasPermission', compact('permissions', 'role'));
    }

    public function assignRole(Request $request, Role $role, $id)
    {
        try {
            $request->validate([
                'role_name' => 'required|exists:roles,name',
            ]);
            $user = User::find($id);
            $user->syncRoles([$request->role_name]);

            return redirect()->back()->with('success', 'Role assigned successfully.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Failed to assign role: ' . $th->getMessage());
        }
    }
}
