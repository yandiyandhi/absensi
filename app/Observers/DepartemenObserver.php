<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Departemen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepartemenObserver
{
    public function created($departemen)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Departemen',
            'model_id'    => $departemen->id,
            'new_data'    => $departemen->toArray(),
            'description' => "Departemen baru dibuat: {$departemen->nama_departemen}",
        ]);
    }

    public function updated($departemen)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Departemen',
            'model_id'    => $departemen->id,
            'new_data'    => $departemen->toArray(),
            'description' => "Departemen diperbarui: {$departemen->nama_departemen}",
        ]);
    }

    public function deleted($departemen)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Departemen',
            'model_id'    => $departemen->id,
            'new_data'    => $departemen->toArray(),
            'description' => "Departemen dihapus: {$departemen->nama_departemen}",
        ]);
    }

    public function saving(Departemen $departemen): void
    {
        $departemen->nama_departemen = collect(explode(' ', $departemen->nama_departemen))
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
