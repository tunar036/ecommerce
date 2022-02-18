<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basket_id')->unique();
            $table->decimal('order_amount',10,4);
            $table->string('status',30)->nullable();
            $table->string('name',50)->nullable();
            $table->string('address',150)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('bank',20)->nullable();
            $table->integer('installment')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('basket_id')->references('id')->on('basket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
