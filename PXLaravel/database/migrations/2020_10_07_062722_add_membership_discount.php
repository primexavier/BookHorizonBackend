<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMembershipDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->integer("buy_discount")->default(0);
            $table->integer("rent_discount")->nullable(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('memberships', 'buy_discount'))
        {
            Schema::table('memberships', function (Blueprint $table) {
                $table->dropColumn(['buy_discount']);
            });
        }
        if (Schema::hasColumn('memberships', 'rent_discount'))
        {
            Schema::table('memberships', function (Blueprint $table) {
                $table->dropColumn(['rent_discount']);
            });
        }
    }
}
