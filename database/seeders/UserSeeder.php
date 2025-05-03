<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            $role = $index % 2 === 0 ? 'admin' : 'siswa';

            $nip = '19' . str_pad($faker->unique()->numberBetween(100000000000000, 999999999999999), 14, '0', STR_PAD_LEFT);

            DB::table('users')->insert([
                'name' => $faker->name,
                'nip' => $nip, 
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => $role,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
