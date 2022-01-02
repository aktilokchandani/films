<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes,CRUDGenerator;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'films';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'slug', 'description', 'country', 'cover_image', 'release_date', 'rating', 'ticket_price', 'created_at', 'updated_at'
    ];


    public function getFilmGenres()
    {
        return $this->hasMany(FilmGenre::class,"film_id","id")
            ->select("film_genres.film_id","genres.*","film_genres.genre_id")
            ->join("genres","genres.id","=","film_genres.genre_id");
    }


    /**
     * This function is used for get record by id
     *
     * @param {object} $request
     * @param  {sting} $id
     * @return Response
     */
    public static function getRecordBySlug($slug)
    {
        $query = self::select();
        $data = $query->where("slug", $slug)->with(["getFilmGenres"])->first();
        return $data;
    }

    /**
     * check cover_image url or local storage file
     *
     * @param $url
     * @return bool
     */
    public function checkUrl($url)
    {

        if (strpos($url, 'http') !== false) {
            return true;
        }

        return false;
    }

    public function getCoverImageAttribute($cover_image){
        $defaultImagePath = \Config::get("constants.DEFAULT_IMAGE_PATH");
        if ($this->checkUrl($cover_image)) {
            return $cover_image;
        } else if (is_file(\Storage::disk('local')->path($cover_image))) {
            return \Storage::disk('local')->url("{$cover_image}");
        } else {
            return \Storage::disk('local')->url("{$defaultImagePath}/user-placeholder.jpg");
        }
    }
}
