<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditJenisIzinRequest;
use App\Http\Requests\JenisIzinRequest;
use App\Models\JenisIzin;
use App\Services\Izin\JenisIzinService;
use Exception;

class JenisIzinController extends Controller
{
    public function index()
    {
        $jenis = JenisIzin::orderBy('nama_izin')->paginate(10);
        return view('izin.jenis.index', compact('jenis'));
    }

    public function store(JenisIzinRequest $request, JenisIzinService $service)
    {
        try {
            $services = $service->create($request->validated());
            return redirect()->back()->with('success', 'Jenis Izin berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(EditJenisIzinRequest $request, JenisIzinService $service, JenisIzin $jenis_izin)
    {
        $services = $service->update($jenis_izin, $request->validated());

        if ($services) {
            return redirect()->back()->with('success', 'Jenis Izin berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Data gagal diperbarui.');
        }
    }

    public function destroy(JenisIzin $jenis_izin, JenisIzinService $service)
    {
        if ($service->delete($jenis_izin)) {
            return redirect()->back()->with('success', 'Jenis Izin berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus.');
        }
    }
}
