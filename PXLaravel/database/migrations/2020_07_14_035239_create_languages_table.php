<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("country");
            $table->string("description")->nullable();
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
        });
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger("language_id")->default(0);
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('books', 'language_id'))
        {
            Schema::table('books', function (Blueprint $table) {
                $table->dropForeign(['language_id']);
            });
        }
        Schema::dropIfExists('languages');
    }
}
