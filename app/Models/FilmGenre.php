<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmGenre extends Model
{
    use SoftDeletes,CRUDGenerator;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'film_genres';

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
        'film_id','genre_id', 'created_at', 'updated_at'
    ];


    /**
     * @param $postData
     * @param $record
     */
    public static function insetBulkData($postData , $record)
    {
        $data = [];
        if($postData['genre_ids']){
            foreach ($postData['genre_ids'] as $genre_id){
                $data[] = [
                    "genre_id" => $genre_id,
                    "film_id" => $record->id,
                ];
            }

            self::insert(
                $data
            );
        }
    }
}
