<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('roles')->insert([
            'id' => 1,
            'nama_role' => 'Admin',
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'nama_role' => 'Kepala Badan',
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'nama_role' => 'Sekretaris',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'nama_role' => 'Bidang Asset',
            'role_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 5,
            'nama_role' => 'Bidang Akuntansi',
            'role_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'nama_role' => 'Bidang Anggaran',
            'role_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 7,
            'nama_role' => 'Bidang Pembendaharaan',
            'role_id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nama' => 'Rivaja Simbolon',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin@123'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'bidang_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
