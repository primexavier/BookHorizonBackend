<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceDetailTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_books', function (Blueprint $table) {
            $table->integer("price")->default(0)->nullable();
        });
        Schema::table('transaction_memberships', function (Blueprint $table) {
            $table->integer("price")->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transaction_books', 'price'))
        {
            Schema::table('transaction_books', function (Blueprint $table) {
                $table->dropColumn(['price']);
            });
        }
        if (Schema::hasColumn('transaction_memberships', 'price'))
        {
            Schema::table('transaction_memberships', function (Blueprint $table) {
                $table->dropColumn(['price']);
            });
        }
    }
}
