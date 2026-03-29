<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $presensi = Presensi::with('user')->where('tanggal', now()->toDateString())->orderBy('jam_masuk', 'asc')->get();
        $user = Presensi::where('tanggal', now()->toDateString())->where('user_id', Auth::user()->id)->first();
        $out = Presensi::with('user')->where('tanggal', now()->toDateString())->whereNotNull('jam_keluar')->orderBy('jam_keluar', 'asc')->get();

        $belumPresensi = User::where('active', '1') // hanya user aktif
            ->whereDoesntHave('presensis', function ($query) {
                $query->whereDate('tanggal', Carbon::today()); // belum ada presensi hari ini
            })
            ->get();

        return view('dashboard', compact('presensi', 'user', 'out', 'belumPresensi'));
    }
}
