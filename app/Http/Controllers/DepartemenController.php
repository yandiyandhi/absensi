<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartemenRequest;
use App\Models\Departemen;
use App\Services\Departemen\DepartemenService;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        $departemen = Departemen::orderBy('nama_departemen')->paginate(10);
        return view('departemen.index', compact('departemen'));
    }

    public function store(DepartemenRequest $request, DepartemenService $departemen)
    {
        try {
            $departemen->create($request->validated());
            return redirect()->back()->with('success', 'Departemen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(DepartemenRequest $request, Departemen $departemen, DepartemenService $departemenService)
    {
        try {
            $departemenService->update($departemen, $request->validated());
            return redirect()->back()->with('success', 'Departemen berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Departemen $departemen, DepartemenService $departemenService)
    {
        try {
            $departemenService->delete($departemen);
            return redirect()->back()->with('success', 'Departemen berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getData()
    {
        $departemen = Departemen::all();
        return response()->json($departemen);
    }
}
