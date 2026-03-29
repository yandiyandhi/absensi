<?php

namespace App\Http\Controllers;

use App\Http\Requests\FotoProfilRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Models\User;
use App\Services\User\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function foto()
    {
        $user = Auth::user();
        return view('profile.foto.fotoProfil', compact('user'));
    }

    public function updatefoto(FotoProfilRequest $request, $id, UserService $userService)
    {
        try {
            $user = User::where('uuid', $id)->firstOrFail();

            $data = $request->validated();
            $data['foto'] = $request->file('foto');

            $userService->update_foto($user, $data);
            return Redirect::route('profile.foto')->with('status', 'Foto profil berhasil diubah');
        } catch (Exception $th) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui foto profil.']);
        }
    }

    public function editProfil()
    {
        $user = Auth::user();
        return view('profile.editProfil', compact('user'));
    }

    public function updateProfil(UpdateProfilRequest $request, $id, UserService $userService)
    {
        try {
            $user = User::where('uuid', $id)->firstOrFail();

            $data = $request->validated();
            $userService->update_profil($user, $data);
            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        } catch (Exception $th) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui profil.']);
        }
    }

    public function password()
    {
        $users = Auth::user();
        return view('profile.editPassword', compact('users'));
    }
}
