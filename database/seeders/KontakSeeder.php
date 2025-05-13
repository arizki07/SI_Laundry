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
        // $kontak = DB::table('kontaks')->first();

        DB::table('kontaks')->insert([
            'head_first' => 'head one',
            'head_two' => 'head dua',
            'logo' => 'path_to_logo_image.jpg',
            'alamat' => 'Alamtmu disini',
            'deskripsi' => '-.',
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
