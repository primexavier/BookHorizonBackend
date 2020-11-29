<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("transaction_type_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
        });
        Schema::table('charts', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books');
        });
        Schema::table('charts', function (Blueprint $table) {
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
        if (Schema::hasColumn('charts', 'book_id'))
        {
            Schema::table('charts', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('charts', 'user_id'))
        {
            Schema::table('charts', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('charts');
    }
}
