<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use App\Models\Izin;
use App\Models\JenisIzin;
use App\Models\Kantor;
use App\Models\User;
use App\Services\Izin\IzinService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Izin::with(['user', 'jenisIzin'])
            ->where('status', 'pending');

        // filter role
        if (method_exists(Auth::user(), 'hasRole')) {
            if (!Auth::user()->hasRole('admin')) {
                $query->where('user_id', Auth::id());
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

    public function edit($id)
    {
        $data = Izin::where('uuid', $id)->with(['user', 'jenisIzin', 'kantor'])->first();
        $jenis_izin = JenisIzin::orderBy('nama_izin', 'asc')->get();
        $kantor = Kantor::orderBy('nama_kantor', 'asc')->get();

        return view('izin.editIzin', compact('data', 'jenis_izin', 'kantor'));
    }

    public function update(IzinRequest $request, $id, IzinService $izinservice)
    {
        $izinservice->update($id, $request->validated());

        return redirect()->back()->with('success', 'Data izi berhasil di update.');
    }

    public function cancel($id, IzinService $izinservice)
    {

        $izinservice->cancel($id);

        return redirect()->back()->with('success', 'Izin berhasil dibatalkan');
    }
}
