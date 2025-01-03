<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Barang::create([
                'nama_mahasiswa' => $faker->name,
                'prodi'          => $faker->randomElement(['Sistem Informasi', 'Teknik Informatika', 'Ilmu Komputer']),
                'barang_pinjam'  => $faker->randomElement(['Laptop', 'Proyektor', 'Printer', 'Tablet']),
                'tanggal_pinjam' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                'tanggal_kembali'=> $faker->optional()->dateTimeBetween('now', '+1 month')?->format('Y-m-d'),
            ]);
        }
    }
}
