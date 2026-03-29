<?php

namespace App\Services\Departemen;

use App\Models\Departemen;
use Illuminate\Support\Facades\DB;

class DepartemenService
{
    public function create(array $data): Departemen
    {
        return DB::transaction(function () use ($data) {
            $departemen = Departemen::withTrashed()->where('nama_departemen', $data['nama_departemen'])->first();

            if ($departemen && !$departemen->trashed()) {
                throw new \Exception('Departemen sudah ada');
            }

            if ($departemen && $departemen->trashed()) {
                $departemen->restore();
                return $departemen;
            }

            $last = Departemen::withTrashed()
                ->orderBy('kode_departemen', 'desc')
                ->lockForUpdate()
                ->first();

            if ($last && $last->kode_departemen) {
                $lastNumber = (int) substr($last->kode_departemen, 4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $data['kode_departemen'] = 'DEPT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            return Departemen::create($data);
        });
    }

    public function update(Departemen $departemen, array $data)
    {
        return DB::transaction(function () use ($departemen, $data) {
            $departemen->update($data);
            return $departemen;
        });
    }

    public function delete(Departemen $departemen): void
    {
        DB::transaction(function () use ($departemen) {
            $departemen->delete();
        });
    }
}
