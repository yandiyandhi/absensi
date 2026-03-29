<?php

namespace App\Services\Kantor;

use App\Models\Kantor;
use Illuminate\Support\Facades\DB;

class KantorService
{
    public function create(array $data): Kantor
    {
        return DB::transaction(function () use ($data) {
            $kantor = Kantor::withTrashed()->where('nama_kantor', $data['nama_kantor'])->first();

            if ($kantor && !$kantor->trashed()) {
                throw new \Exception('Kantor sudah ada');
            }

            if ($kantor && $kantor->trashed()) {
                $kantor->restore();
                return $kantor;
            }

            $last = Kantor::withTrashed()
                ->orderBy('kode_kantor', 'desc')
                ->lockForUpdate()
                ->first();

            if ($last && $last->kode_kantor) {
                $lastNumber = (int) substr($last->kode_kantor, 4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $data['kode_kantor'] = 'KTR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            return Kantor::create($data);
        });
    }

    public function update(Kantor $kantor, array $data): bool
    {
        return $kantor->update($data);
    }

    public function delete(Kantor $kantor): bool
    {
        return $kantor->delete();
    }
}
