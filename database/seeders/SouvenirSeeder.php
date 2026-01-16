<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Souvenir;

class SouvenirSeeder extends Seeder
{
    public function run(): void
    {
        // ======================
        // KATEGORI
        // ======================
        $kategori = [
            'Souvenir Bayi',
            'Souvenir Pernikahan',
            'Souvenir Ulang Tahun',
            'Souvenir Aqiqah',
        ];

        foreach ($kategori as $nama) {
    Category::firstOrCreate(
        ['nama' => $nama],          // kondisi
        ['nama_kategori' => $nama]  // data insert
    );
        }

        // ======================
        // PRODUK
        // ======================
        $data = [
            ['nama_produk' => 'Souvenir Botol Susu Mini', 'kategori' => 'Souvenir Bayi', 'harga' => 3500],
            ['nama_produk' => 'Souvenir Sendok Garpu Bayi', 'kategori' => 'Souvenir Bayi', 'harga' => 5000],
            ['nama_produk' => 'Gantungan Kunci Acrylic Custom', 'kategori' => 'Souvenir Pernikahan', 'harga' => 2500],
            ['nama_produk' => 'Souvenir Handuk Mini', 'kategori' => 'Souvenir Ulang Tahun', 'harga' => 7000],
            ['nama_produk' => 'Souvenir Tas Serut Custom', 'kategori' => 'Souvenir Aqiqah', 'harga' => 8500],
            ['nama_produk' => 'Souvenir Mug Custom Nama', 'kategori' => 'Souvenir Pernikahan', 'harga' => 15000],
            ['nama_produk' => 'Souvenir Sabun Handmade', 'kategori' => 'Souvenir Aqiqah', 'harga' => 4000],
            ['nama_produk' => 'Souvenir Tempat Pensil Lucu', 'kategori' => 'Souvenir Ulang Tahun', 'harga' => 6000],
        ];

        foreach ($data as $item) {
            $category = Category::where('nama_kategori', $item['kategori'])->first();

            if (!$category) {
                continue; // proteksi
            }

            Souvenir::create([
                'category_id' => $category->id,
                'nama_produk' => $item['nama_produk'],
                'harga' => $item['harga'],
                'stok' => rand(50, 200),
                'deskripsi' => 'Souvenir berkualitas, bisa custom nama & tema acara.',
            ]);
        }
    }
}
