<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTimeTz('start', 0);	
            $table->dateTimeTz('end', 0);	
            $table->boolean("is_percent");
            $table->integer("type");     
            $table->integer("total");            
            $table->text("description");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
        });
        Schema::create('promotion_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("promotion_id");
            $table->unsignedBigInteger("book_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
            $table->foreign('promotion_id')->references('id')->on('promotions');
            $table->foreign('book_id')->references('id')->on('books');
        });
        Schema::create('promotion_membership', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("promotion_id");
            $table->unsignedBigInteger("membership_id");            
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
            $table->foreign('promotion_id')->references('id')->on('promotions');
            $table->foreign('membership_id')->references('id')->on('memberships');
        });
        Schema::create('promotion_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("promotion_id");
            $table->unsignedBigInteger("user_id");            
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);
            $table->foreign('promotion_id')->references('id')->on('promotions');
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
        if (Schema::hasColumn('promotion_user', 'promotion_id'))
        {
            Schema::table('promotion_user', function (Blueprint $table) {
                $table->dropForeign(['promotion_id']);
                $table->dropForeign(['user_id']);
            });
        }
        if (Schema::hasColumn('promotion_book', 'promotion_id'))
        {
            Schema::table('promotion_book', function (Blueprint $table) {
                $table->dropForeign(['promotion_id']);
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('promotion_membership', 'promotion_id'))
        {
            Schema::table('promotion_membership', function (Blueprint $table) {
                $table->dropForeign(['promotion_id']);
                $table->dropForeign(['membership_id']);
            });
        }        
        if (Schema::hasTable('promotion_user'))
        {
            Schema::dropIfExists('promotion_user');            
        }     
        if (Schema::hasTable('promotion_book'))
        {
            Schema::dropIfExists('promotion_book');            
        }
        if (Schema::hasTable('promotion_membership'))
        {
            Schema::dropIfExists('promotion_membership');            
        }
        Schema::dropIfExists('promotions');
    }
}
