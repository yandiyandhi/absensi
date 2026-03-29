<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $presensi = Presensi::with('user')->where('tanggal', now()->toDateString())->orderBy('jam_masuk', 'asc')->get();
        return view('others.leaderboard', compact('presensi'));
    }
}
