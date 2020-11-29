<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("user_id");
            $table->integer("adjustment");
            $table->integer("quantity");
            $table->text("description")->nullable();
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
        if (Schema::hasColumn('stocks', 'book_id'))
        {
            Schema::table('stocks', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('stocks', 'user_id'))
        {
            Schema::table('stocks', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('stocks');
    }
}
