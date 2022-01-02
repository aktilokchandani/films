<?php

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gerneData = [
            ["name"=>"adventure","slug"=>\Str::slug("adventure")],
            ["name"=>"action","slug"=>\Str::slug("action")],
            ["name"=>"biography","slug"=>\Str::slug("biography")],
            ["name"=>"animation","slug"=>\Str::slug("animation")],
            ["name"=>"mystery","slug"=>\Str::slug("mystery")],
            ["name"=>"horror","slug"=>\Str::slug("horror")],
            ["name"=>"romance","slug"=>\Str::slug("romance")],
            ["name"=>"thriller","slug"=>\Str::slug("thriller")],
            ["name"=>"war","slug"=>\Str::slug("war")],
            ["name"=>"war","slug"=>\Str::slug("superhero")],
             
        ];

        \DB::table("genres")->insert($gerneData);
    }
}
