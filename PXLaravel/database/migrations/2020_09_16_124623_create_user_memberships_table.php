<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("membership_id");
            $table->boolean('is_active')->default(true);	
            $table->dateTime('expired', 0);	
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('membership_id')->references('id')->on('memberships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_memberships', 'user_id'))
        {
            Schema::table('user_memberships', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        if (Schema::hasColumn('user_memberships', 'membership_id'))
        {
            Schema::table('user_memberships', function (Blueprint $table) {
                $table->dropForeign(['membership_id']);
            });
        }
        Schema::dropIfExists('user_memberships');
    }
}
