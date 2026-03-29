<?php

namespace App\Services\Izin;

use App\Models\JenisIzin;
use Illuminate\Support\Facades\DB;

class JenisIzinService
{
    public function create(array $data): JenisIzin
    {
        return DB::transaction(function () use ($data) {
            $jenis = JenisIzin::withTrashed()->where('nama_izin', $data['nama_izin'])->first();

            if ($jenis && !$jenis->trashed()) {
                throw new \Exception('Departemen sudah ada');
            }

            if ($jenis && $jenis->trashed()) {
                $jenis->restore();
                return $jenis;
            }

            return JenisIzin::create($data);
        });
    }

    public function update(JenisIzin $jenis, array $data): bool
    {
        return DB::transaction(function () use ($jenis, $data) {
            return $jenis->update($data);
        });
    }

    public function delete(JenisIzin $jenis): bool
    {
        return DB::transaction(function () use ($jenis) {
            return $jenis->delete();
        });
    }
}
