<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Izin extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = ['jam_mulai' => 'datetime:H:i', 'jam_selesai' => 'datetime:H:i'];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function jenisIzin()
    {
        return $this->belongsTo(JenisIzin::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->uuid = Str::uuid();
        });
    }
}
