<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'barang_id' => 1,
                'jumlah' => 7,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 1,
                'barang_id' => 2,
                'jumlah' => 10,
                'harga' => 14000,
            ],
            [
                'penjualan_id' => 1,
                'barang_id' => 3,
                'jumlah' => 10,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 4,
                'jumlah' => 15,
                'harga' => 6000,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 5,
                'jumlah' => 2,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 6,
                'jumlah' => 20,
                'harga' => 4000,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 7,
                'jumlah' => 10,
                'harga' => 5000,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 8,
                'jumlah' => 10,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 9,
                'jumlah' => 2,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 4,
                'barang_id' => 10,
                'jumlah' => 2,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 4,
                'barang_id' => 1,
                'jumlah' => 7,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 4,
                'barang_id' => 2,
                'jumlah' => 7,
                'harga' => 14000,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 3,
                'jumlah' => 10,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 4,
                'jumlah' => 10,
                'harga' => 6000,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 5,
                'jumlah' => 1,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 6,
                'barang_id' => 6,
                'jumlah' => 10,
                'harga' => 4000,
            ],
            [
                'penjualan_id' => 6,
                'barang_id' => 7,
                'jumlah' => 7,
                'harga' => 5000,
            ],
            [
                'penjualan_id' => 6,
                'barang_id' => 8,
                'jumlah' => 8,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 7,
                'barang_id' => 9,
                'jumlah' => 8,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 7,
                'barang_id' => 10,
                'jumlah' => 10,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 7,
                'barang_id' => 1,
                'jumlah' => 10,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 8,
                'barang_id' => 2,
                'jumlah' => 4,
                'harga' => 14000,
            ],
            [
                'penjualan_id' => 8,
                'barang_id' => 3,
                'jumlah' => 7,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 8,
                'barang_id' => 4,
                'jumlah' => 1,
                'harga' => 6000,
            ],
            [
                'penjualan_id' => 9,
                'barang_id' => 5,
                'jumlah' => 7,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 9,
                'barang_id' => 6,
                'jumlah' => 7,
                'harga' => 4000,
            ],
            [
                'penjualan_id' => 9,
                'barang_id' => 7,
                'jumlah' => 5,
                'harga' => 5000,
            ],
            [
                'penjualan_id' => 10,
                'barang_id' => 5,
                'jumlah' => 12,
                'harga' => 10000,
            ],
            [
                'penjualan_id' => 10,
                'barang_id' => 6,
                'jumlah' => 9,
                'harga' => 4000,
            ],
            [
                'penjualan_id' => 10,
                'barang_id' => 7,
                'jumlah' => 5,
                'harga' => 5000,
            ],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
