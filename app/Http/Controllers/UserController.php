<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Kantor;
use App\Models\User;
use App\Services\User\UserService;
use FFI\Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $user  = User::with(['kantor', 'jabatan.departemen', 'roles'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")

                        ->orWhereHas('kantor', function ($q2) use ($search) {
                            $q2->where('nama_kantor', 'like', "%{$search}%");
                        })

                        ->orWhereHas('jabatan', function ($q2) use ($search) {
                            $q2->where('nama_jabatan', 'like', "%{$search}%");
                        })

                        ->orWhereHas('jabatan.departemen', function ($q2) use ($search) {
                            $q2->where('nama_departemen', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('users.index', compact('user'));
    }

    public function create(Request $request)
    {
        $departemen = Departemen::orderBy('nama_departemen')->get();
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();
        $kantor = Kantor::orderBy('nama_kantor')->get();

        return view('users.addUser', compact('departemen', 'jabatan', 'kantor'));
    }

    public function store(UserRequest $request, UserService $userService)
    {
        try {
            $userService->create($request->validated());
            return redirect()->back()->with('success', 'User berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($user)
    {
        $users = User::with(['kantor', 'jabatan.departemen'])->where('uuid', $user)->first();

        $departemen = Departemen::orderBy('nama_departemen')->get();
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();
        $kantor = Kantor::orderBy('nama_kantor')->get();

        return view('users.editUser', compact('users', 'departemen', 'jabatan', 'kantor'));
    }

    public function update(EditUserRequest $request, UserService $userService, User $user)
    {
        try {
            $userService->update($user, $request->validated());
            return redirect()->back()->with('success', 'User berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }


    public function password($user)
    {
        $users = User::where('uuid', $user)->first();

        return view('users.updatePassword', compact('users'));
    }

    public function update_password(UpdatePasswordRequest $request, User $user, UserService $userService)
    {
        try {
            $userService->update_password($user, $request->validated());
            return redirect()->back()->with('success', 'Password berhasil diubah.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
