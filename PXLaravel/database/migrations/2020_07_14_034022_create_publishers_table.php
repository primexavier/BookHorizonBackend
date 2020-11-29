<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description")->nullable();
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
        });
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger("publisher_id")->default(0);
            $table->foreign('publisher_id')->references('id')->on('publishers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('books', 'publisher_id'))
        {
            Schema::table('books', function (Blueprint $table) {
                $table->dropForeign(['publisher_id']);
            });
        }
        Schema::dropIfExists('publishers');
    }
}
