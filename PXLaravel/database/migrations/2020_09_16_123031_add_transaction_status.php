<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string("status")->default(0)->nullable();
            $table->boolean("is_active")->default(true);
            //
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->string("status")->default(0)->nullable();
            //
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
            $table->dropColumn(['status']);
            $table->dropColumn(['is_active']);
            //
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
