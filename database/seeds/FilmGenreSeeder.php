<?php

use Illuminate\Database\Seeder;

class FilmGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $filmData = [];
        $genreData = [];
        $films = \DB::table("films")->get();
        $genres = \DB::table("genres")->get();

        if (!empty($films) && sizeof($films)) {
            foreach ($films as $film) {
                $filmData[$film->slug] = $film->id;
            }
        }

        if (!empty($genres) && sizeof($genres)) {
            foreach ($genres as $genre) {
                $genreData[$genre->slug] = $genre->id;
            }
        }

        $filmGenreData =
            [

                [
                    "film_id" => $filmData[\Str::slug("Venom")],
                    "genre_id" => $genreData[\Str::slug("horror")],
                ],
                [
                    "film_id" => $filmData[\Str::slug("Jurassic World")],
                    "genre_id" => $genreData[\Str::slug("adventure")],
                ],[
                    "film_id" => $filmData[\Str::slug("Spider-Man: Far from Home")],
                    "genre_id" => $genreData[\Str::slug("superhero")],
                ],
                [
                    "film_id" => $filmData[\Str::slug("Hulk")],
                    "genre_id" => $genreData[\Str::slug("superhero")],
                ],
                
                
            ];

        \DB::table("film_genres")->insert($filmGenreData);
    }
}
