<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("photo")->nullable();
            $table->string("isbn")->nullable();
            $table->string("publication_city")->nullable();
            $table->string("format")->nullable();
            $table->string("pages")->nullable();
            $table->string("weight")->nullable();
            $table->string("dimension")->nullable();
            $table->string("purchase_price")->nullable();
            $table->string("start_qty")->nullable();
            $table->string("vendor")->nullable();
            $table->text("description")->nullable();
            $table->integer("price")->default(0);
            $table->string("product_code")->nullable();
            $table->datetime("purchase_date")->nullable();
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
