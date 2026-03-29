<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $data = User::with('kantor')->where('id', $user->id)->first();

        return view('others.lokasi', compact('data'));
    }
}
