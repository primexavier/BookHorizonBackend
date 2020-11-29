<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChartDuration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charts', function (Blueprint $table) {
            $table->integer("duration")->default(0);
        });
        Schema::table('transaction_books', function (Blueprint $table) {
            $table->integer("duration")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('charts', 'duration'))
        {
            Schema::table('charts', function (Blueprint $table) {
                $table->dropColumn(['duration']);
            });
        }
        if (Schema::hasColumn('transaction_books', 'duration'))
        {
            Schema::table('transaction_books', function (Blueprint $table) {
                $table->dropColumn(['duration']);
            });
        }
    }
}
