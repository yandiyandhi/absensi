<?php

namespace App\Observers;

use App\Models\Acara;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AcaraObserver
{
    /**
     * Handle the Acara "created" event.
     */
    public function created(Acara $acara): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'Acara',
            'model_id'    => $acara->id,
            'new_data'    => $acara->toArray(),
            'description' => "Acara baru dibuat: {$acara->nama_acara}",
        ]);
    }

    /**
     * Handle the Acara "updated" event.
     */
    public function updated(Acara $acara): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'Acara',
            'model_id'    => $acara->id,
            'new_data'    => $acara->toArray(),
            'description' => "Acara diperbarui: {$acara->nama_acara}",
        ]);
    }

    /**
     * Handle the Acara "deleted" event.
     */
    public function deleted(Acara $acara): void
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'Acara',
            'model_id'    => $acara->id,
            'new_data'    => $acara->toArray(),
            'description' => "Acara dihapus: {$acara->nama_acara}",
        ]);
    }

    public function creating(Acara $acara): void
    {
        $acara->created_at = null;
    }

    public function saving(Acara $acara)
    {
        $acara->nama_acara = Str::title($acara->nama_acara);
    }
}
