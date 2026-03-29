<?php

namespace App\Http\Controllers;

use App\Http\Requests\JabatanRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Services\Jabatan\JabatanService;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $jabatan = Jabatan::orderBy('nama_jabatan')->paginate(10);
        $departemen = Departemen::orderBy('nama_departemen')->get();

        $relation = Jabatan::with('departemen')->get();

        return view('jabatan.index', compact('jabatan', 'departemen', 'relation'));
    }

    public function store(JabatanRequest $request, JabatanService $jabatan)
    {
        try {
            $jabatan->create($request->validated());
            return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(JabatanRequest $request, Jabatan $jabatan, JabatanService $jabatanService)
    {
        try {
            $jabatanService->update($jabatan, $request->validated());
            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Jabatan $jabatan, JabatanService $jabatanService)
    {
        try {
            $jabatanService->delete($jabatan);
            return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function dataDepartemen($id)
    {
        $jabatan = Jabatan::where('uuid', $id)->first();
        return response()->json($jabatan);
    }
}
