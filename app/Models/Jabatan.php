<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Jabatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::creating(function ($department) {
            $department->uuid = Str::uuid();
        });
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
}
