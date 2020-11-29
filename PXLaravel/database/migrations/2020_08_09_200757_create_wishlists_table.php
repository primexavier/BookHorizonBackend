<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("user_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
        });
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books');
        });
        Schema::table('wishlists', function (Blueprint $table) {
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
        if (Schema::hasColumn('wishlists', 'book_id'))
        {
            Schema::table('wishlists', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('wishlists', 'user_id'))
        {
            Schema::table('wishlists', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('wishlists');
    }
}
