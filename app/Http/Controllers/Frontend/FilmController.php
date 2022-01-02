<?php


namespace App\Http\Controllers\Frontend;


use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('frontend.films.index');
    }

    /**
     *
     * @param $slug
     * @return $film data
     */
    public function show($slug)
    {
        $film = Film::getRecordBySlug($slug);

        if(empty($film)){
            return abort("404");
        }

        return view("frontend.films.show", ["data" => $film]);
    }

    /**
     * @return view
     */
    public function create()
    {
        $genres = Genre::whereNull("deleted_at")->get();
        return view("frontend.films.create", ["genres" =>$genres]);
    }
}