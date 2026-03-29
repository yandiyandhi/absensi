<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class UserService
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        return $user->update($data);
    }

    public function update_password(User $user, array $data)
    {
        return $user->update($data);
    }

    public function update_foto(User $user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {

            if (isset($data['foto']) && $data['foto'] instanceof UploadedFile) {

                $file = $data['foto'];
                $filename = uniqid() . '.jpg';

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(1200, null)
                    ->toJpeg(80);

                Storage::disk('public')->put('foto_profil/' . $filename, (string) $image);

                if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                    Storage::disk('public')->delete($user->foto);
                }

                $data['foto'] = 'foto_profil/' . $filename;
            }

            $user->update($data);

            return $user;
        });
    }

    public function update_profil(User $user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {
            $user->update($data);
            return $user;
        });
    }
}
