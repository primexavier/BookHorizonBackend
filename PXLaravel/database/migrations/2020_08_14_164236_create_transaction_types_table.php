<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
        });
        Schema::table('charts', function (Blueprint $table) {
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('charts', 'transaction_type_id'))
        {
            Schema::table('charts', function (Blueprint $table) {
                $table->dropForeign(['transaction_type_id']);
            });
        }
        Schema::dropIfExists('transaction_types');
    }
}
