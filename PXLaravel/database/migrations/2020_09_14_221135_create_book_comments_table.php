<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("comment_id");
            $table->unsignedBigInteger("book_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('book_comments', 'book_id'))
        {
            Schema::table('book_comments', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('book_comments', 'comment_id'))
        {
            Schema::table('book_comments', function (Blueprint $table) {
                $table->dropForeign(['comment_id']);
            });
        }
        Schema::dropIfExists('book_comments');
    }
}
