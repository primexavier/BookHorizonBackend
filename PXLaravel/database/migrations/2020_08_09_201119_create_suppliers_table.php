<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
        });
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger("supplier_id")->default(0);
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('books', 'supplier_id'))
        {
            Schema::table('books', function (Blueprint $table) {
                $table->dropForeign(['supplier_id']);
            });
        }
        Schema::dropIfExists('suppliers');
    }
}
