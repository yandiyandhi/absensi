<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensis';
    protected $guarded = ['id'];
    protected $casts = ['jam_masuk' => 'datetime:H:i', 'jam_keluar' => 'datetime:H:i'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}