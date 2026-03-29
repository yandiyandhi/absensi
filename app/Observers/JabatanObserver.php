<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JabatanObserver
{
    public function created(Jabatan $jabatan): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Jabatan',
            'model_id'    => $jabatan->id,
            'new_data'    => $jabatan->toArray(),
            'description' => "Jabatan baru dibuat: {$jabatan->nama_jabatan}",
        ]);
    }

    public function updated(Jabatan $jabatan): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Jabatan',
            'model_id'    => $jabatan->id,
            'new_data'    => $jabatan->toArray(),
            'description' => "Jabatan diperbarui: {$jabatan->nama_jabatan}",
        ]);
    }

    public function deleted(Jabatan $jabatan): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Jabatan',
            'model_id'    => $jabatan->id,
            'new_data'    => $jabatan->toArray(),
            'description' => "Jabatan dihapus: {$jabatan->nama_jabatan}",
        ]);
    }

    public function saving(Jabatan $jabatan): void
    {
        $jabatan->nama_jabatan = collect(explode(' ', $jabatan->nama_jabatan))
            ->map(function ($word) {
                $length = strlen($word);

                if ($length <= 3) {
                    return strtoupper($word);
                }

                return Str::title($word);
            })
            ->implode(' ');
    }
}