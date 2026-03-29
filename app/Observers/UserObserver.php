<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserObserver
{
    public function created(User $user)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'create',
            'model'       => 'User',
            'model_id'    => $user->id,
            'new_data'    => $user->toArray(),
            'description' => "User baru dibuat: {$user->name}",
        ]);
    }

    public function updated(User $user)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'update',
            'model'       => 'User',
            'model_id'    => $user->id,
            'new_data'    => $user->toArray(),
            'description' => "User diperbarui: {$user->name}",
        ]);
    }

    public function deleted(User $user)
    {
        ActivityLog::create([
            'user_name'   => Auth::user()?->username ?? 'Guest',
            'action'      => 'delete',
            'model'       => 'User',
            'model_id'    => $user->id,
            'new_data'    => $user->toArray(),
            'description' => "User dihapus: {$user->name}",
        ]);
    }

    public function creating(User $user): void
    {
        $user->updated_at = null;
    }

    public function saving(User $user)
    {
        $user->name = Str::title($user->name);
    }
}
