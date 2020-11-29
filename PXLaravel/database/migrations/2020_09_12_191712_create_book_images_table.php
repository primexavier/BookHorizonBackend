<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("image_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('book_images', 'book_id'))
        {
            Schema::table('book_images', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('book_images', 'image_id'))
        {
            Schema::table('book_images', function (Blueprint $table) {
                $table->dropForeign(['image_id']);
            });
        }
        Schema::dropIfExists('book_images');
    }
}
