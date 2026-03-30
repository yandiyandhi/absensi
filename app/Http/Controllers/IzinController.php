<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use App\Models\Izin;
use App\Models\JenisIzin;
use App\Models\User;
use App\Services\Izin\IzinService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Izin::with(['user', 'jenisIzin'])
            ->where('status', 'pending');

        // filter role
        if (method_exists(auth()->user(), 'hasRole')) {
            if (!auth()->user()->hasRole('admin')) {
                $query->where('user_id', auth()->id());
            }
        }

        // filter tanggal
        $query->when($tanggalAwal && $tanggalAkhir, function ($q) use ($tanggalAwal, $tanggalAkhir) {
            $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        })->when($tanggalAwal && !$tanggalAkhir, function ($q) use ($tanggalAwal) {
            $q->whereDate('tanggal', '>=', $tanggalAwal);
        })->when(!$tanggalAwal && $tanggalAkhir, function ($q) use ($tanggalAkhir) {
            $q->whereDate('tanggal', '<=', $tanggalAkhir);
        });

        // order (lebih aman)
        $query->orderBy('created_at', 'desc');
        $data = $query->paginate(10)->withQueryString();

        // dd($data);
        return view('izin.index', compact('data'));
    }

    public function approval_izin()
    {
        $data = Izin::join('users', 'izins.user_id', '=', 'users.id')
            ->join('jenis_izins', 'izins.jenis_izin_id', '=', 'jenis_izins.id')
            ->where('izins.status', 'pending')
            ->orderBy('users.name')
            ->select('izins.*')
            ->with(['user', 'jenisIzin'])
            ->paginate(10);

        return view('izin.approval.index', compact('data'));
    }

    public function approve($id)
    {
        try {
            $izin = Izin::find($id);
            $izin->status = 'disetujui';
            $izin->save();

            return redirect()->back()->with('success', 'Izin berhasil disetujui.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Izin gagal disetujui.');
        }
    }

    public function tolak($id)
    {
        try {
            $izin = Izin::find($id);
            $izin->status = 'ditolak';
            $izin->save();

            return redirect()->back()->with('success', 'Izin berhasil ditolak.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Izin gagal ditolak.');
        }
    }

    public function create()
    {
        $user = User::with('kantor')->find(Auth::user()->id);
        $jenis_izin = JenisIzin::get();
        return view('izin.addIzin', compact('user', 'jenis_izin'));
    }

    public function store(IzinRequest $request, IzinService $izinService)
    {
        try {
            $izinService->create($request->validated());
            return redirect()->back()->with('success', 'Izin berhasil diajukan.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Izin gagal diajukan.');
        }
    }
}
