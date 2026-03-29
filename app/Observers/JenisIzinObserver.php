<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\JenisIzin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JenisIzinObserver
{
    public function created(JenisIzin $jenisIzin): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Jenis Izin',
            'model_id'    => $jenisIzin->id,
            'new_data'    => $jenisIzin->toArray(),
            'description' => "Jenis Izin baru dibuat: {$jenisIzin->nama_izin}",
        ]);
    }

    public function updated(JenisIzin $jenisIzin): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Jenis Izin',
            'model_id'    => $jenisIzin->id,
            'new_data'    => $jenisIzin->toArray(),
            'description' => "Jenis Izin diperbarui: {$jenisIzin->nama_izin}",
        ]);
    }

    public function deleted(JenisIzin $jenisIzin): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Jenis Izin',
            'model_id'    => $jenisIzin->id,
            'new_data'    => $jenisIzin->toArray(),
            'description' => "Jenis Izin diperbarui: {$jenisIzin->nama_izin}",
        ]);
    }

    public function saving(JenisIzin $jenisIzin): void
    {
        $jenisIzin->nama_izin = Str::title($jenisIzin->nama_izin);
    }
}
