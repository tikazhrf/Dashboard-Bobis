<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('order_id')->unique();
            $table->bigInteger('total_price');
            $table->integer('total_ticket');
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_status', ['Unpaid', 'Paid']);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('kontak_penumpang');
            $table->foreign('bus_id')->references('id')->on('buses');
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
        Schema::dropIfExists('transactions');
    }
};
