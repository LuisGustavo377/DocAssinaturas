<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            ['id' => Str::uuid(), 'name' => 'Admin Inicial', 'email' => 'admin@admin.com', 'password' => '$2y$12$x.vXWMvho4nnqn9s0r3dVukqCncez1DaIhPfM6yJNPkDv/BQafmDS','email_verified_at' => null, 'remember_token' => null,'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('admins')->insert($admin);
    }
}
