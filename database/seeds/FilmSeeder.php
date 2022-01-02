<?php

use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filmData = [
          [
              "name" => "Venom",
              "slug" => \Str::slug("Venom"),
              "description" => "A reporter battles a mad scientist in a fight for his life after merging with a snarky alien symbiote that gives him remarkable superpowers.",
              "country" => "USA",
              "cover_image" => "https://occ-0-3587-58.1.nflxso.net/dnm/api/v6/tx1O544a9T7n8Z_G12qaboulQQE/AAAABWIzyfeVo1klpHI-18mcNXtaydIqHOUwG17ItUW2x-oSGgwqqGR_Wa4DXG8N5pUX0Ad0a7OjwHm5uw2TuyCYh3F2GVoaJThfrAw.webp?r=2ae",
              "release_date" => "2021-10-5",
              "rating" => rand(1,5),
              "ticket_price" => '499.00'
          ],
            [
                "name" => "Jurassic World",
                "slug" => \Str::slug("Jurassic World"),
                "description" => "The owners of a dinosaur theme park try to attract tourists with a thrilling new exhibit, but a deadly giant breaks loose and terrorizes the island.",
                "country" => "USA",
                "cover_image" => "https://occ-0-3587-58.1.nflxso.net/dnm/api/v6/X194eJsgWBDE2aQbaNdmCXGUP-Y/AAAABRw3mY0IgYPmd21jCrrDwJtnq3K-bNBeK39xrllVZUYRtXGQWWCWf_tSEbqbwJKQbTZb89WqYL-klahI1woLcrw5s_E.webp?r=7ad",
                "release_date" => "2015-06-10",
                "rating" => rand(1,5),
                "ticket_price" => '660.00'
            ],
            [
                "name" => "Spider-Man: Far from Home",
                "slug" => \Str::slug("Spider-Man: Far from Home"),
                "description" => "Even your friendly neighborhood superhero can use a vacation. But a new threat forces Peter Parker to swing into action during a school trip to Europe.	",
                "country" => "USA",
                "cover_image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxjeW3OAfcDjUwm7fCNqdIEiE9dLjKXJY6CQ2Cjky-ri-pbVik",
                "release_date" => "2019-06-26",
                "rating" => rand(1,5),
                "ticket_price" => '350.00'
            ],
            [
                "name" => "Hulk",
                "slug" => \Str::slug("Hulk"),
                "description" => "Researcher Bruce Banner's failed experiments cause him to mutate into a powerful and savage green-skinned hulk when he loses control of his emotions.",
                "country" => "USA",
                "cover_image" => "https://m.media-amazon.com/images/M/MV5BMDY0YjVhMjMtY2U4Yy00NjNkLTlmMzYtMmVmYTA4M2IzOTAzXkEyXkFqcGdeQXVyMTEyNDk3MjY3.V1_SY500_CR10,40,340,500.jpg",
                "release_date" => "2003-06-17",
                "rating" => rand(1,5),
                "ticket_price" => '250.00'
            ],
       
        ];

        \DB::table("films")->insert($filmData);
    }
}
