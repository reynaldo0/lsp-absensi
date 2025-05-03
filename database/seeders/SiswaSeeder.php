<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $nisnStart = 12100;
        $kelasList = [
            'X RPL',
            'XI RPL',
            'XII RPL',
            'X BR',
            'XI BR',
            'XII BR',
            'X AKL',
            'XI AKL',
            'XII AKL',
        ];

        foreach (range(1, 20) as $index) {
            $nisn = $nisnStart + $index;

            if (DB::table('siswas')->where('nisn', $nisn)->exists()) {
                continue;
            }

            DB::table('siswas')->insert([
                'nisn' => strval($nisn),
                'nama' => $faker->name,
                'jenis_kelamin' => $index % 2 === 0 ? 'laki' : 'perempuan',
                'kelas' => $kelasList[array_rand($kelasList)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
