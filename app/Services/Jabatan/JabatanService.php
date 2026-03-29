<?php

namespace App\Services\Jabatan;

use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;

class JabatanService
{
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $jabatan = Jabatan::withTrashed()->where('nama_jabatan', $data['nama_jabatan'])->first();

            if ($jabatan && !$jabatan->trashed()) {
                throw new \Exception('Jabatan sudah ada');
            }

            if ($jabatan && $jabatan->trashed()) {
                $jabatan->restore();
                return $jabatan;
            }

            $last = Jabatan::withTrashed()
                ->orderBy('kode_jabatan', 'desc')
                ->lockForUpdate()
                ->first();

            if ($last && $last->kode_jabatan) {
                $lastNumber = (int) substr($last->kode_jabatan, 4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $data['kode_jabatan'] = 'JBT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            return Jabatan::create($data);
        });
    }

    public function update(Jabatan $jabatan, array $data)
    {
        $jabatan->update($data);
        return true;
    }

    public function delete(Jabatan $jabatan)
    {
        DB::transaction(function () use ($jabatan) {
            $jabatan->delete();
        });
    }
}
