<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->integer("sub_total")->nullable();
            $table->integer("shipping_cost")->nullable();
            $table->integer("grand_total")->nullable();
            $table->integer("product_total");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
        });
        Schema::table('transactions', function (Blueprint $table) {
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('transactions');
    }
}
