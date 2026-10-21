<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    // Akun admin awal. Ubah lewat .env: ADMIN_EMAIL dan ADMIN_PASSWORD
    public function run()
    {
        $admin = User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@baliticket.test')],
            ['name' => 'Administrator', 'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin12345'))]
        );

        // role sengaja tidak masuk $fillable, jadi diisi eksplisit
        $admin->forceFill(['role' => 'admin'])->save();
    }
}
