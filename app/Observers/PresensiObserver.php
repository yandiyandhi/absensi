<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class PresensiObserver
{
    public function created(Presensi $presensi)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Presensi',
            'model_id'    => $presensi->id,
            'new_data'    => $presensi->toArray(),
            'description' => "Presensi baru dibuat: {$presensi->name}",
        ]);
    }

    public function updated(Presensi $presensi)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Presensi',
            'model_id'    => $presensi->id,
            'old_data'    => $presensi->getOriginal(),
            'new_data'    => $presensi->toArray(),
            'description' => "Presensi diperbarui: {$presensi->name}",
        ]);
    }

    public function deleted(Presensi $presensi)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Presensi',
            'model_id'    => $presensi->id,
            'old_data'    => $presensi->toArray(),
            'description' => "Presensi dihapus: {$presensi->name}",
        ]);
    }
}
