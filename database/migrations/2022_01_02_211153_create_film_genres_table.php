<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->default(0)->constrained("films")->onDelete("cascade");
            $table->foreignId('genre_id')->default(0)->constrained("genres")->onDelete("cascade");
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->index("created_at");
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes()->index("deleted_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_geners');
    }
}
