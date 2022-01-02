<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenreSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FilmSeeder::class);
        $this->call(FilmGenreSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
