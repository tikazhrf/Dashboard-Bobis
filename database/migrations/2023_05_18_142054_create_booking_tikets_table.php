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
        Schema::create('booking_tikets', function (Blueprint $table) {
            $table->id();
            $table->string('seat');
            $table->foreignId('jenis_tikets_id')->constrained('jenis_tikets');
            $table->foreignId('jadwals_id')->constrained('jadwals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('buses_id')->constrained('buses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('penumpang_id')->nullable()->default(null);
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
        Schema::dropIfExists('booking_tikets');
    }
};
