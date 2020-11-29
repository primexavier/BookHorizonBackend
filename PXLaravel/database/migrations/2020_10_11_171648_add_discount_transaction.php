<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer("discount")->nullable();
        });
        Schema::table('transaction_books', function (Blueprint $table) {
            $table->integer("discount")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transactions', 'discount'))
        {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn(['discount']);
            });
        }
        if (Schema::hasColumn('transaction_books', 'discount'))
        {
            Schema::table('transaction_books', function (Blueprint $table) {
                $table->dropColumn(['discount']);
            });
        }
    }
}
