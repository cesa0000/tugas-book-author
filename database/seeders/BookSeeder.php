<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['author' => 'andrea.hirata@example.com', 'title' => 'Laskar Pelangi', 'description' => 'Kisah sepuluh anak Belitung yang berjuang mendapatkan pendidikan.', 'published_year' => 2005, 'price' => 85000],
            ['author' => 'tere.liye@example.com', 'title' => 'Bumi', 'description' => 'Petualangan Raib, Seli, dan Ali di dunia paralel.', 'published_year' => 2014, 'price' => 90000],
            ['author' => 'pramoedya@example.com', 'title' => 'Bumi Manusia', 'description' => 'Kisah Minke pada masa kolonial Hindia Belanda.', 'published_year' => 1980, 'price' => 110000],
            ['author' => 'dee.lestari@example.com', 'title' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh', 'description' => 'Novel pembuka serial Supernova yang memadukan sains dan romansa.', 'published_year' => 2001, 'price' => 95000],
            ['author' => 'raditya.dika@example.com', 'title' => 'Kambing Jantan', 'description' => 'Catatan harian komedi seorang mahasiswa Indonesia di Australia.', 'published_year' => 2005, 'price' => 70000],
        ];

        foreach ($books as $item) {
            $author = Author::where('email', $item['author'])->first();

            Book::create([
                'author_id' => $author->id,
                'title' => $item['title'],
                'description' => $item['description'],
                'published_year' => $item['published_year'],
                'price' => $item['price'],
            ]);
        }
    }
}
