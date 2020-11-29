<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("transaction_id");
            $table->string("shipping_code");
            $table->integer("status")->default(0);
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
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
        if (Schema::hasColumn('transaction_shippings', 'transaction_id'))
        {
            Schema::table('transaction_shippings', function (Blueprint $table) {
                $table->dropForeign(['transaction_id']);
            });
        }
        Schema::dropIfExists('transaction_shippings');
    }
}
