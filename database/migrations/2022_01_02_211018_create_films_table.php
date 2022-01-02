<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->index("name");
            $table->string('slug',50)->index("slug");
            $table->longText('description')->nullable();
            $table->decimal('ticket_price',5,2)->default(0);
            $table->string('country')->nullable()->index("country");
            $table->date('release_date')->index("release_date");
            $table->text('cover_image')->nullable();
            $table->enum('rating',[0,1,2,3,4,5])->default(0);
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
        Schema::dropIfExists('films');
    }
}
