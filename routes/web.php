<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisIzinController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/rolesync', function () {
//     $id = 2;

//     $user = \App\Models\User::findOrFail($id);

//     $user->syncRoles('admin');

//     return 'Role berhasil di set';
// });

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(LeaderboardController::class)->group(function () {
        Route::get('/leaderboard', 'index')->name('leaderboard.index');
    });

    Route::controller(LokasiController::class)->group(function () {
        Route::get('/lokasi', 'index')->name('lokasi.index');
    });

    Route::controller(CutiController::class)->group(function () {
        Route::get('/approval/cuti', 'approval_cuti')->name('cuti.approval_cuti');
    });

    Route::controller(DepartemenController::class)->group(function () {
        Route::get('/departemen', 'index')->name('departemen.index');
        Route::post('/departemen', 'store')->name('departemen.store');
        Route::put('/departemen/{departemen}', 'update')->name('departemen.update');
        Route::delete('/departemen/{departemen}', 'destroy')->name('departemen.destroy');

        Route::get('/departemen/get-data', 'getData')->name('departemen.getData');
    });

    Route::controller(JabatanController::class)->group(function () {
        Route::get('/jabatan', 'index')->name('jabatan.index');
        Route::post('/jabatan', 'store')->name('jabatan.store');
        Route::put('/jabatan/{jabatan}', 'update')->name('jabatan.update');
        Route::delete('/jabatan/{jabatan}', 'destroy')->name('jabatan.destroy');

        Route::get('/jabatan/departemen/{id}', 'dataDepartemen')->name('jabatan.departemen');
    });

    Route::controller(KantorController::class)->group(function () {
        Route::get('/kantor', 'index')->name('kantor.index');
        Route::get('/kantor/create', 'create')->name('kantor.create');
        Route::post('/kantor', 'store')->name('kantor.store');
        Route::get('/kantor/edit/{id}', 'edit')->name('kantor.edit');
        Route::put('/kantor/{kantor}', 'update')->name('kantor.update');
        Route::delete('/kantor/{kantor}', 'destroy')->name('kantor.destroy');
    });

    Route::controller(PresensiController::class)->group(function () {
        Route::get('/presensi/histori', 'histori')->name('presensi.histori');
        Route::get('/presensi', 'presensi')->name('presensi.presensi');
        Route::post('/presensi', 'store')->name('presensi.store');
    });

    Route::controller(IzinController::class)->group(function () {
        Route::get('/approval/izin', 'approval_izin')->name('izin.approval_izin');
        Route::PUT('/izin/approve/{id}', 'approve')->name('izin.approve');
        Route::PUT('/izin/tolak/{id}', 'tolak')->name('izin.tolak');

        Route::get('/izin', 'index')->name('izin.index');
        Route::get('/izin/add', 'create')->name('izin.create');
        Route::post('/izin', 'store')->name('izin.store');
    });

    Route::controller(JenisIzinController::class)->group(function () {
        Route::get('/jenis-izin', 'index')->name('jenis-izin.index');
        Route::post('/jenis-izin', 'store')->name('jenis-izin.store');
        Route::put('/jenis-izin/{jenis_izin}', 'update')->name('jenis-izin.update');
        Route::delete('/jenis-izin/{jenis_izin}', 'destroy')->name('jenis-izin.destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/add', 'create')->name('users.create');
        Route::post('/users', 'store')->name('users.store');
        Route::get('/users/edit/{user}', 'edit')->name('users.edit');
        Route::get('/users/password/{user}', 'password')->name('users.password');
        Route::PUT('/users/password/{user}', 'update_password')->name('users.update_password');
        Route::put('/users/{user}', 'update')->name('users.update');
        Route::delete('/users/{user}', 'destroy')->name('users.destroy');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/role', 'index')->name('role.index');
        Route::get('/role/add', 'create')->name('role.create');
        Route::post('/role', 'store')->name('role.store');
        Route::get('/role/edit/{id}', 'edit')->name('role.edit');
        Route::put('/role/{role}', 'update')->name('role.update');
        Route::get('/role/permissions/{role}', 'permissions')->name('role.permissions');
        Route::post('/role/permission/{role}', 'assignPermission')->name('role.assignPermission');

        Route::get('/role/user/{user}', 'roleUser')->name('role.roleUser');
        Route::post('/role/user/{id}', 'assignRole')->name('role.assignRole');
    });

    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permission', 'index')->name('permission.index');
        Route::get('/permission/create', 'create')->name('permission.create');
        Route::post('/permission', 'store')->name('permission.store');
        Route::get('/permission/edit/{permission}', 'edit')->name('permission.edit');
        Route::put('/permission/{permission}', 'update')->name('permission.update');
    });

    Route::controller(AcaraController::class)->group(function () {
        Route::get('/acara', 'index')->name('acara.index');
        Route::get('/acara/show/{id}', 'show')->name('acara.show');
        Route::get('/acara/create', 'create')->name('acara.create');
        Route::post('/acara', 'store')->name('acara.store');
        Route::get('/acara/edit/{id}', 'edit')->name('acara.edit');
        Route::put('/acara/{id}', 'update')->name('acara.update');
        Route::get('/acara/status/{id}', 'status')->name('acara.status');
        Route::put('/acara/status/{id}', 'updateStatus')->name('acara.updateStatus');
    });

    Route::get('/profile/foto', [ProfileController::class, 'foto'])->name('profile.foto');
    Route::put('/profile/foto/{id}', [ProfileController::class, 'updatefoto'])->name('profile.foto.update');
    Route::get('/profile/edit', [ProfileController::class, 'editProfil'])->name('profile.editProfil');
    Route::put('/profile/edit/{id}', [ProfileController::class, 'updateProfil'])->name('profile.updateProfil');
    Route::get('/user/password', [ProfileController::class, 'password'])->name('user.password');


    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
