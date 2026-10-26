<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Andrea Hirata', 'email' => 'andrea.hirata@example.com', 'bio' => 'Penulis novel asal Belitung, dikenal lewat tetralogi Laskar Pelangi.'],
            ['name' => 'Tere Liye', 'email' => 'tere.liye@example.com', 'bio' => 'Penulis novel populer Indonesia dengan puluhan buku fiksi dan fantasi.'],
            ['name' => 'Pramoedya Ananta Toer', 'email' => 'pramoedya@example.com', 'bio' => 'Sastrawan Indonesia yang karyanya diterjemahkan ke banyak bahasa.'],
            ['name' => 'Dee Lestari', 'email' => 'dee.lestari@example.com', 'bio' => 'Penulis dan musisi, pencipta serial Supernova.'],
            ['name' => 'Raditya Dika', 'email' => 'raditya.dika@example.com', 'bio' => 'Penulis, komedian, dan sutradara dengan gaya buku komedi pribadi.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
