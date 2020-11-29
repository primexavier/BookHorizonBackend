<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_genres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("genre_id");
            $table->unsignedBigInteger("book_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('book_genres', 'book_id'))
        {
            Schema::table('book_genres', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('book_genres', 'genre_id'))
        {
            Schema::table('book_genres', function (Blueprint $table) {
                $table->dropForeign(['genre_id']);
            });
        }
        Schema::dropIfExists('book_genres');
    }
}
