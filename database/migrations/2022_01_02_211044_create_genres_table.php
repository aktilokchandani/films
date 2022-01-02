<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index("name");
            $table->string('slug')->index("slug");
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
        Schema::dropIfExists('geners');
    }
}
