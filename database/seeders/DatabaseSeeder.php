<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Kategori Contoh
        $tekno = Category::create([
            'name' => 'Teknologi', 
            'slug' => 'teknologi'
        ]);
        
        $olahraga = Category::create([
            'name' => 'Olahraga', 
            'slug' => 'olahraga'
        ]);

        // Buat Berita Contoh
        Post::create([
            'category_id' => $tekno->id,
            'title' => 'Laravel Merilis Versi Terbaru dengan Fitur Kecepatan Ekstrem',
            'slug' => 'laravel-merilis-versi-terbaru',
            'body' => 'Ini adalah isi berita lengkap mengenai pembaruan framework Laravel yang semakin memudahkan para developer web...',
        ]);

        Post::create([
            'category_id' => $olahraga->id,
            'title' => 'Timnas Indonesia Siap Hadapi Laga Internasional Bulan Ini',
            'slug' => 'timnas-indonesia-siap-hadapi-laga',
            'body' => 'Ini adalah isi berita lengkap mengenai persiapan latihan skuad Garuda menjelang pertandingan penting...',
        ]);
    }
}