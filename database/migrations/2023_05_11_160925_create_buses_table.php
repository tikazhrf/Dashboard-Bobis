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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('code_bus')->unique();
            $table->string('vin');
            $table->string('plate_number');
            $table->date('bpkb_expired');
            $table->string('driver');
            $table->integer('total_seats');
            $table->foreignId('company_id')->constrained('company');
            $table->foreignId('jadwals_id')->constrained('jadwals');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
};
