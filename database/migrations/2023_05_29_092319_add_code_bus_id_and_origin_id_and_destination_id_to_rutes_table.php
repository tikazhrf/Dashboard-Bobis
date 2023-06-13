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
        Schema::table('rutes', function (Blueprint $table) {
            $table->foreignId('origin_id')->constrained('bus_stops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('destination_id')->constrained('bus_stops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rutes', function (Blueprint $table) {
            $table->dropColumn('code_bus_id');
        });
    }
};
