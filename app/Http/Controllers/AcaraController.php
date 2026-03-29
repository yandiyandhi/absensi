<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcaraRequest;
use App\Models\Acara;
use App\Services\Acara\AcaraService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AcaraController extends Controller
{
    public function show($id)
    {
        $acara = Acara::where('uuid', $id)->first();
        if (!empty($acara)) {
            $acara->nama_acara = Str::title($acara->nama_acara);
            $acara->lokasi = Str::title($acara->lokasi);
        }

        return view('acara.detailAcara', compact('acara'));
    }

    public function index()
    {
        $acara = Acara::where('status', 'aktif')->orderBy('created_at', 'desc')->get();

        foreach ($acara as $key => $value) {
            if (!empty($value)) {
                $value->nama_acara = Str::title($value->nama_acara);
                $value->lokasi = Str::title($value->lokasi);
            }
        }
        return view('acara.index', compact('acara'));
    }

    public function create()
    {
        return view('acara.createAcara');
    }

    public function store(AcaraRequest $request, AcaraService $acaraService)
    {
        $acaraService->create($request->validated());
        return redirect()->back()->with('success', 'Acara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $acara = Acara::where('uuid', $id)->first();
        return view('acara.editAcara', compact('acara'));
    }

    public function update(AcaraRequest $request, $id, AcaraService $acaraService)
    {
        $acara = Acara::where('uuid', $id)->first();
        if ($acara) {
            $acaraService->update($acara, $request->validated());
            return redirect()->back()->with('success', 'Acara berhasil diperbarui.');
        }
        return redirect()->back()->with('error', 'Acara tidak ditemukan.');
    }

    public function status($id)
    {
        $acara = Acara::where('uuid', $id)->first();
        return view('acara.updateAcara', compact('acara'));
    }

    public function updateStatus($id, AcaraService $acaraService)
    {
        request()->validate([
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $acara = Acara::where('uuid', $id)->first();
        if ($acara) {
            $acaraService->updateStatus($acara, request('status'));
            return redirect()->back()->with('success', 'Status acara berhasil diperbarui.');
        }
        return redirect()->back()->with('error', 'Acara tidak ditemukan.');
    }
}
