<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin
        User::updateOrCreate(
            ['email' => 'admin@perpus.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Akun anggota contoh
        User::updateOrCreate(
            ['email' => 'anggota@perpus.test'],
            [
                'name' => 'Anggota Perpustakaan',
                'password' => Hash::make('password'),
                'role' => 'anggota',
            ]
        );

        $categories = [
            'Novel' => 'Karya fiksi naratif panjang.',
            'Teknologi' => 'Buku seputar komputer, pemrograman, dan teknologi.',
            'Sains' => 'Ilmu pengetahuan alam dan eksakta.',
            'Sejarah' => 'Peristiwa dan tokoh masa lampau.',
            'Bisnis' => 'Manajemen, ekonomi, dan kewirausahaan.',
        ];

        foreach ($categories as $name => $desc) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => $desc]
            );
        }

        $novel = Category::where('slug', 'novel')->first();
        $tech = Category::where('slug', 'teknologi')->first();
        $sains = Category::where('slug', 'sains')->first();

        $books = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, $novel->id, 5],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, $novel->id, 3],
            ['Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, $tech->id, 4],
            ['Pemrograman Laravel Modern', 'Tim Penulis', 'Informatika', 2023, $tech->id, 6],
            ['Cosmos', 'Carl Sagan', 'Random House', 1980, $sains->id, 2],
            ['A Brief History of Time', 'Stephen Hawking', 'Bantam', 1988, $sains->id, 3],
        ];

        foreach ($books as [$title, $author, $publisher, $year, $categoryId, $stock]) {
            Book::updateOrCreate(
                ['title' => $title],
                [
                    'author' => $author,
                    'publisher' => $publisher,
                    'year' => $year,
                    'category_id' => $categoryId,
                    'stock' => $stock,
                    'isbn' => (string) random_int(1000000000000, 9999999999999),
                    'description' => 'Contoh data buku untuk Sistem Manajemen Perpustakaan.',
                ]
            );
        }
    }
}
