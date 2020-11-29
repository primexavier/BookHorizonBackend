<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
        });
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger("author_id")->default(0);
            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('books', 'author_id'))
        {
            Schema::table('books', function (Blueprint $table) {
                $table->dropForeign(['author_id']);
            });
        }
        Schema::dropIfExists('authors');
    }
}
