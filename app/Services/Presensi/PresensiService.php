<?php

namespace App\Services\Presensi;

use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PresensiService
{
    public function presensi(array $data)
    {
        ini_set('memory_limit', '256M');

        $user = Auth::user();
        $kantor = $user->kantor;

        if (!$kantor) {
            throw new \Exception('Data kantor tidak ditemukan');
        }

        $latitude  = str_replace(',', '.', $data['latitude']);
        $longitude = str_replace(',', '.', $data['longitude']);

        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            throw new \Exception('Koordinat tidak valid');
        }

        if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
            throw new \Exception('Koordinat di luar batas');
        }

        $jarak = $this->hitungJarak(
            $latitude,
            $longitude,
            $kantor->latitude,
            $kantor->longitude
        );

        if ($jarak > $kantor->radius) {
            throw new \Exception('Anda berada di luar radius kantor');
        }

        $pathFoto = null;

        if (!empty($data['foto']) && str_contains($data['foto'], 'data:image')) {

            preg_match('/data:image\/(\w+);base64,/', $data['foto'], $type);

            $image = preg_replace('/^data:image\/\w+;base64,/', '', $data['foto']);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('Gagal decode foto');
            }

            $extension = $type[1] ?? 'jpg';
            $fileName = 'upload_presensi/' . time() . '_' . uniqid() . '.' . $extension;

            //Pakai ImageManager
            $manager = new ImageManager(new Driver());

            $img = $manager->read($image)
                ->scale(width: 600) // resize max width 600px
                ->toJpeg(75); // compress kualitas 75%

            Storage::disk('public')->put($fileName, $img);

            $pathFoto = $fileName;
        }

        if (!$pathFoto) {
            throw new \Exception('Foto gagal disimpan');
        }

        $presensi = Presensi::where('user_id', $user->id)
            ->where('tanggal', now()->toDateString())
            ->first();

        if ($presensi) {
            $presensi->update([
                'lat_keluar'   => $latitude,
                'lng_keluar'   => $longitude,
                'foto_keluar'  => $pathFoto,
                'jam_keluar'   => now()->format('H:i:s'),
                'updated_at'   => now(),
            ]);

            return $presensi;
        }

        return Presensi::create([
            'user_id'       => $user->id,
            'kantor_id'     => $kantor->id,
            'lat_masuk'     => $latitude,
            'lng_masuk'     => $longitude,
            'foto_masuk'    => $pathFoto,
            'tanggal'       => now()->toDateString(),
            'jam_masuk'     => now()->format('H:i:s'),
            'jarak'         => $jarak,
            'created_at'    => now(),
        ]);
    }


    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon / 2) *
            sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
