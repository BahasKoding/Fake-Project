<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        for ($i = 1; $i <= 15; $i++) {
            User::create([
                'name'      => 'Warga' . $i,
                'username'  => 'warga' . $i,
                'password'  => bcrypt('12345'),
                'role'      => 'Warga'
            ]);
        }

        User::create([
            'name'      => 'Unit Kerja',
            'username'  => 'UnitKerja',
            'password'  => bcrypt('12345'),
            'role'      => 'Unit-Kerja'
        ]);
        User::create([
            'name'      => 'UPT',
            'username'  => 'upt',
            'password'  => bcrypt('12345'),
            'role'      => 'UPT'
        ]);
        User::create([
            'name'      => 'Mentri Sosial',
            'username'  => 'mensos',
            'password'  => bcrypt('12345'),
            'role'      => 'Mentri-Sosial'
        ]);
    }
}
