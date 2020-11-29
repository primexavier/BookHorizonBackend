<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("account");
            $table->text("description")->nullable();
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger("bank_id"); 
            $table->foreign('bank_id')->references('id')->on('banks');
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
                $table->dropForeign(['bank_id']);
            });
        }
        Schema::dropIfExists('banks');
    }
}
