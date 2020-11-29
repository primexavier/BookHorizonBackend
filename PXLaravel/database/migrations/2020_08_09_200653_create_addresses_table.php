<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id"); 
            $table->string("name");
            $table->string("la")->nullable();
            $table->string("lg")->nullable();
            $table->string("phone_no");
            $table->text("full_address");
            $table->integer("country_id");
            $table->integer("province_id");
            $table->integer("city_id");
            $table->integer("zip_code");
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
        if (Schema::hasColumn('addresses', 'user_id'))
        {
            Schema::table('addresses', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        Schema::dropIfExists('addresses');
    }
}
