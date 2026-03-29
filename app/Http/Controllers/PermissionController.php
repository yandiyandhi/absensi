<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = DB::table('permissions')->orderBy('name')->get();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.createPermission');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'permission_name' => 'required|string|max:255',
            ]);

            DB::table('permissions')->insert([
                'name' => $request->permission_name,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            return redirect()->back()->with('success', 'Permission berhasil ditambahkan.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Permission gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        $permission = DB::table('permissions')->where('id', $id)->first();
        return view('permissions.editPermission', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'permission_name' => 'required|string|max:255',
            ]);

            DB::table('permissions')->where('id', $id)->update([
                'name' => $request->permission_name,
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Permission berhasil diubah.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Permission gagal diubah.');
        }
    }
}
