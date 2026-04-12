<?php

namespace App\Services\Izin;

use App\Models\Izin;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class IzinService
{
    public function create(array $data): Izin
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['file']) && $data['file'] instanceof UploadedFile) {

                $file = $data['file'];
                $filename = uniqid() . '.jpg';

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(1200, null)
                    ->toJpeg(80);

                Storage::disk('public')->put('upload_izin/' . $filename, (string) $image);

                $data['file'] = 'upload_izin/' . $filename;
            }

            return Izin::create($data);
        });
    }

    public function update($id, array $data)
    {
        $izin = Izin::where('id', $id)->first();
        return DB::transaction(function () use ($data, $izin) {
            if (isset($data['file']) && $data['file'] instanceof UploadedFile) {

                $file = $data['file'];
                $filename = uniqid() . '.jpg';

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(1200, null)
                    ->toJpeg(80);

                Storage::disk('public')->put('upload_izin/' . $filename, (string) $image);

                $data['file'] = 'upload_izin/' . $filename;
            }

            return $izin->update($data);
        });
    }

    public function cancel($id)
    {
        $izin = Izin::findOrFail($id);
        return DB::transaction(function () use ($izin) {
            $izin->status = "batal";

            return $izin->save();
        });
    }
}
