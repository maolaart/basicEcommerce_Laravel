<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i<=20 ; $i++) { 
            Produk::create([
                'id_kategori' => rand(1,3),
                'id_subkategori' => rand(1,3),
                'nama_barang' => 'Fashion',
                'gambar' => 'Shop_img_'.$i. '.jpg',
                'deskripsi' =>'Desciption' ,
                'harga' => rand(10000,100000) ,
                'diskon' => 0,
                'bahan' => 'Material',
                'tags' => 'Tags',
                'sku' => Str::random(8),
                'ukuran' => 'S,M,L,XL',
                'warna' => 'Black,White,Brown',
            ]);
        }
    }
}
