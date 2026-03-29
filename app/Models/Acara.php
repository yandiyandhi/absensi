<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Acara extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::creating(function ($acara) {
            $acara->uuid = Str::uuid();
        });

        static::saving(function ($acara) {
            $acara->nama_acara = Str::title(trim($acara->nama_acara));
            $acara->lokasi = Str::title(trim($acara->lokasi));
        });
    }
}
