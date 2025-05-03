<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();

        // // Mendapatkan semua siswa yang ada di database
        // $siswas = Siswa::all();

        // // Keterangan absensi yang tersedia
        // $keteranganOptions = ['Terlambat', 'Sakit', 'Izin', 'Alpha'];

        // // Membuat absensi untuk setiap siswa
        // foreach ($siswas as $siswa) {
        //     DB::table('absensis')->insert([
        //         'siswa_id' => $siswa->id,
        //         'keterangan' => $keteranganOptions[array_rand($keteranganOptions)], // Pilih keterangan acak
        //         'tanggal' => $faker->date(), // Pilih tanggal acak
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
