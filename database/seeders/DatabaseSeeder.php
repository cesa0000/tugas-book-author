<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // AuthorSeeder harus dijalankan lebih dulu karena books bergantung pada authors
        $this->call([
            AuthorSeeder::class,
            BookSeeder::class,
        ]);
    }
}
