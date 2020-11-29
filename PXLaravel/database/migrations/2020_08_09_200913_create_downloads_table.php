<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");       
            $table->string("name");
            $table->string("file");
            $table->string("expired");
            $table->boolean("is_active");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('downloads', 'user_id'))
        {
            Schema::table('downloads', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('downloads');
    }
}
