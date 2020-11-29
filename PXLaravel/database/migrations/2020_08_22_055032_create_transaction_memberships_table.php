<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("transaction_id");
            $table->unsignedBigInteger("membership_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('transaction_id')->references('id')->on('transactions');
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
        if (Schema::hasColumn('transaction_memberships', 'membership_id'))
        {
            Schema::table('transaction_memberships', function (Blueprint $table) {
                $table->dropForeign(['membership_id']);
            });
        }
        if (Schema::hasColumn('transaction_memberships', 'transaction_id'))
        {
            Schema::table('transaction_memberships', function (Blueprint $table) {
                $table->dropForeign(['transaction_id']);
            });
        }
        Schema::dropIfExists('transaction_memberships');
    }
}
