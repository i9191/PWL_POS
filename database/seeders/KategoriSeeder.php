<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_kode' => 'MNM',
                'kategori_nama' => 'Minuman',
            ],
            [
                'kategori_kode' => 'MKN',
                'kategori_nama' => 'Makanan',
            ],
            [
                'kategori_kode' => 'ATK',
                'kategori_nama' => 'Alat Tulis Kantor',
            ],
            [
                'kategori_kode' => 'ELK',
                'kategori_nama' => 'Elektronik',
            ],
            [
                'kategori_kode' => 'SBK',
                'kategori_nama' => 'Sembako',
            ],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
