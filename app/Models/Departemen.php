<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Departemen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'departemens';

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

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class);
    }
}
