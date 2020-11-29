<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("book_id");
            $table->integer("rating");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('reviews', 'book_id'))
        {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        if (Schema::hasColumn('reviews', 'image_id'))
        {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('reviews');
    }
}
