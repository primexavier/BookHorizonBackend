<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger("payment_method_id")->default(1);
            $table->unsignedBigInteger("address_id")->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transactions', 'payment_method_id'))
        {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropForeign(['payment_method_id']);
                $table->dropColumn(['payment_method_id']);
            });
        }
        if (Schema::hasColumn('transactions', 'address_id'))
        {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropForeign(['address_id']);
                $table->dropColumn(['address_id']);
            });
        }
    }
}
