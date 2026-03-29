<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Kantor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KantorObserver
{
    public function created(Kantor $kantor)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Kantor',
            'model_id'    => $kantor->id,
            'new_data'    => $kantor->toArray(),
            'description' => "Kantor baru dibuat: {$kantor->nama_kantor}",
        ]);
    }

    public function updated(Kantor $kantor)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Kantor',
            'model_id'    => $kantor->id,
            'old_data'    => $kantor->getOriginal(),
            'new_data'    => $kantor->toArray(),
            'description' => "Kantor diperbarui: {$kantor->nama_kantor}",
        ]);
    }

    public function deleted(Kantor $kantor)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Kantor',
            'model_id'    => $kantor->id,
            'old_data'    => $kantor->toArray(),
            'description' => "Kantor dihapus: {$kantor->nama_kantor}",
        ]);
    }

    public function saving(Kantor $kantor)
    {
        $kantor->nama_kantor = Str::title($kantor->nama_kantor);
    }
}
