<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_ref')->length(20);
            $table->string('flw_transid')->length(10)->nullable();
            $table->string('firstname')->length(50);
            $table->string('lastname')->length(50);
            $table->string('email')->length(100);
            $table->string('phone')->length(11)->nullable();
            $table->decimal('amount')->length(15,2);
            $table->string('status')->length(10);

            $table->timestamps();
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
