<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresensiRequest;
use App\Models\Presensi;
use App\Models\User;
use App\Services\Presensi\PresensiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function histori(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Presensi::query();

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereDate('jam_masuk', '>=', $tanggalAwal)
                ->whereDate('jam_masuk', '<=', $tanggalAkhir);
        } else {
            $today = Carbon::today();
            $query->whereDate('jam_masuk', $today);
        }

        $presensis = $query->orderBy('tanggal', 'asc')->get();

        return view('presensi.histori', compact('presensis'));
    }

    public function presensi()
    {
        $user = Auth::user();
        $data = User::with('kantor')->where('id', $user->id)->first();

        return view('presensi.absensi.presensi', compact('data'));
    }

    public function store(PresensiRequest $request, PresensiService $presensiService)
    {
        try {
            $presensiService->presensi($request->validated());

            return back()->with('success', 'Presensi berhasil');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
