<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Izin;
use Illuminate\Support\Facades\Auth;

class IzinObserver
{
    public function created(Izin $izin)
    {
        $namaJenisIzin = $izin->jenisIzin?->nama_izin ?? 'N/A';
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Izin',
            'model_id'    => $izin->id,
            'new_data'    => $izin->toArray(),
            'description' => "Izin baru dibuat: {$namaJenisIzin}",
        ]);
    }

    public function updated(Izin $izin)
    {
        $namaJenisIzin = $izin->jenisIzin?->nama_izin ?? 'N/A';
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Izin',
            'model_id'    => $izin->id,
            'new_data'    => $izin->toArray(),
            'description' => "Izin diperbarui: {$namaJenisIzin}",
        ]);
    }

    public function deleted(Izin $izin)
    {
        $namaJenisIzin = $izin->jenisIzin?->nama_izin ?? 'N/A';
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Izin',
            'model_id'    => $izin->id,
            'new_data'    => $izin->toArray(),
            'description' => "Izin dihapus: {$namaJenisIzin}",
        ]);
    }
}