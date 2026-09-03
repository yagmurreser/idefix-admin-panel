<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = json_decode(
            File::get(database_path('data/authors.json')),
            true
        );

        foreach ($authors as $author) {
            Author::updateOrCreate(
                ['id' => $author['author_id']],
                ['author_name' => $author['author_name']]
            );
        }
    }
}