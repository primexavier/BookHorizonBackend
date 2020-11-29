<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("book_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('book_categories', 'book_id'))
        {
            Schema::table('book_categories', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('book_categories', 'category_id'))
        {
            Schema::table('book_categories', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }
        Schema::dropIfExists('book_categories');
    }
}
