<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("user_id");
            $table->boolean('is_active')->default(true);	
            $table->boolean('is_return')->default(false);	
            $table->dateTime('expired_at', 0);	
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
        if (Schema::hasColumn('user_books', 'book_id'))
        {
            Schema::table('user_books', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('user_books', 'user_id'))
        {
            Schema::table('user_books', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('user_books');
    }
}
