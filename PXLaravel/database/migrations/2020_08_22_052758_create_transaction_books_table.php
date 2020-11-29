<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("transaction_id");
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("transaction_type_id");
            $table->softDeletes('deleted_at', 0);	
            $table->timestamps(0);	
            $table->foreign('transaction_type_id')->references('id')->on('transactions');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transaction_books', 'book_id'))
        {
            Schema::table('transaction_books', function (Blueprint $table) {
                $table->dropForeign(['book_id']);
            });
        }
        if (Schema::hasColumn('transaction_books', 'transaction_id'))
        {
            Schema::table('transaction_books', function (Blueprint $table) {
                $table->dropForeign(['transaction_id']);
            });
        }
        if (Schema::hasColumn('transaction_books', 'transaction_type_id'))
        {
            Schema::table('transaction_books', function (Blueprint $table) {
                $table->dropForeign(['transaction_type_id']);
            });
        }
        Schema::dropIfExists('transaction_books');
    }
}
