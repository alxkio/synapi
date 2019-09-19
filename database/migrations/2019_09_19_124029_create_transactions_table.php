<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_l', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('transactionDate');
            $table->string('description');
            $table->decimal('amount');
            $table->decimal('balance');
			$table->date('valuedDate');
			$table->string('account');
			$table->string('category');
			$table->bigInteger('userid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_l');
    }
}
