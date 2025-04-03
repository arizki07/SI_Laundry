<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Periksa apakah $kontak sudah ada, atau buat data baru
        $kontak = DB::table('kontaks')->first();

        // Menambahkan data ke tabel kontaks
        DB::table('kontaks')->insert([
            'head_first' => 'Welcome to Our Website',
            'head_two' => 'Best Services for You',
            'logo' => $kontak ? null : 'path_to_logo_image.jpg', // Jika $kontak ada, logo nullable
            'alamat' => 'Jl. Raya No. 123, Jakarta, Indonesia',
            'deskripsi' => 'Kami adalah perusahaan yang menawarkan layanan terbaik di bidang teknologi.',
            'maps' => 'https://www.google.com/maps/place/123+Street,+Jakarta',
            'no_hp' => '081234567890',
            'email' => 'contact@ourwebsite.com',
            'instagram' => 'https://www.instagram.com/ourwebsite',
            'facebook' => 'https://www.facebook.com/ourwebsite',
            'twitter' => 'https://www.twitter.com/ourwebsite',
            'youtube' => 'https://www.youtube.com/ourwebsite',
        ]);
    }
}
