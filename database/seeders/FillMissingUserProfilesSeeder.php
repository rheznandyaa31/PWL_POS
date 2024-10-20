<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;
use App\Models\ProfilUserModel;

class FillMissingUserProfilesSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan semua user yang belum memiliki profil
        $users = UserModel::doesntHave('profil')->get();

        foreach ($users as $user) {
            // Membuat profil untuk user yang belum memiliki profil
            ProfilUserModel::create([
                'user_id' => $user->id, // Pastikan primary key yang benar, biasanya 'id'
                'tempat_lahir' => null, // Nilai null bisa di-skip jika kolom di DB nullable
                'tanggal_lahir' => null,
                'jenis_kelamin' => null,
                'agama' => null,
                'no_hp' => null,
                'alamat' => null,
            ]);
        }
    }
}
