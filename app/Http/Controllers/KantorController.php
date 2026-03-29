<?php

namespace App\Http\Controllers;

use App\Http\Requests\KantorRequest;
use App\Models\Kantor;
use App\Services\Kantor\KantorService;
use FFI\Exception;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    public function index(Request $request)
    {
        $kantor = Kantor::orderBy('nama_kantor', 'asc')->paginate(10);

        return view('kantor.index', compact('kantor'));
    }

    public function create()
    {
        return view('Kantor.addKantor');
    }

    public function store(KantorRequest $request, KantorService $kantorService)
    {
        try {
            $kantorService->create($request->validated());
            return redirect()->back()->with('success', 'Kantor created successfully.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $kantor = Kantor::where('uuid', $id)->first();

        return view('Kantor.editKantor', compact('kantor'));
    }

    public function update(KantorRequest $request, Kantor $kantor, KantorService $kantorService)
    {
        try {
            $kantorService->update($kantor, $request->validated());
            return redirect()->back()->with('success', 'Kantor updated successfully.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Kantor $kantor, KantorService $kantorService)
    {
        try {
            $kantorService->delete($kantor);
            return redirect()->back()->with('success', 'Kantor deleted successfully.');
        } catch (Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
