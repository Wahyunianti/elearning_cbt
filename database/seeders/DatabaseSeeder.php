<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'role_name' => 'guru',
        ]);

        Role::create([
            'role_name' => 'siswa',
        ]);
        // \App\Models\User::factory(5)->create();
        User::factory(5)->create()->each(function ($user) {
            if ($user->role_id == 2) {
                Siswa::create([
                    'users_id' => $user->id,
                ]);
            }else{
                Guru::create([
                    'users_id' => $user->id,
                ]);
            }
        });
        // \App\Models\User::factory()->create([
        //     'nama' => 'Wahyuni Anti',
        //     'username' => 'wahyuni',
        //     'email' => 'siswa@gmail.com',
        //     'no_induk'=> 1067,
        //     'kelas'=> '7B',
        //     'password' => bcrypt('mtsn2'),
        //     'role_id' => 2
        // ]);

        // \App\Models\User::factory()->create([
        //     'nama' => 'Admin',
        //     'username' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'no_induk'=> 7708,
        //     'kelas'=> '7B',
        //     'password' => bcrypt('mtsn2'),
        //     'role_id' => 1
        // ]);
    }
}
