<?php

namespace App\Services\Acara;

use App\Models\Acara;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;

class AcaraService
{
    public function create(array $data): Acara
    {
        return DB::transaction(function () use ($data) {

            if (isset($data['foto']) && $data['foto'] instanceof UploadedFile) {

                $file = $data['foto'];

                if ($file->getSize() > 10 * 1024 * 1024) {
                    throw new \Exception('Ukuran foto maksimal 10MB');
                }

                $filename = uniqid() . '.jpg';

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(1200, null) // resize lebar 1200
                    ->toJpeg(80);

                Storage::disk('public')->put('foto_acara/' . $filename, (string) $image);

                $data['foto'] = 'foto_acara/' . $filename;
            }

            return Acara::create($data);
        });
    }

    public function update(Acara $acara, array $data): Acara
    {
        return DB::transaction(function () use ($acara, $data) {

            if (isset($data['foto']) && $data['foto'] instanceof UploadedFile) {

                $file = $data['foto'];

                if ($file->getSize() > 10 * 1024 * 1024) {
                    throw new \Exception('Ukuran foto maksimal 10MB');
                }

                if ($acara->foto) {
                    Storage::disk('public')->delete($acara->foto);
                }

                $filename = uniqid() . '.jpg';

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(1200, null) // resize lebar 1200
                    ->toJpeg(80);

                Storage::disk('public')->put('foto_acara/' . $filename, (string) $image);

                $data['foto'] = 'foto_acara/' . $filename;
            }

            $acara->update($data);

            return $acara;
        });
    }

    public function updateStatus(Acara $acara, string $status): Acara
    {
        return DB::transaction(function () use ($acara, $status) {
            $acara->update(['status' => $status]);
            return $acara;
        });
    }
}
