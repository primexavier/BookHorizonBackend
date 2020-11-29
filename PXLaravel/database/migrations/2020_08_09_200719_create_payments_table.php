<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); 
            $table->string("name");
            $table->integer("total"); 
            $table->boolean("status"); 
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("transaction_id"); 
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('payments', 'transaction_id'))
        {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['transaction_id']);
            });
        }
        Schema::dropIfExists('payments');
    }
}
