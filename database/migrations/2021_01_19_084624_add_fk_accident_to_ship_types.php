<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkAccidentToShipTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ship_types', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_accident_protect');
            $table->foreign('fk_accident_protect')->references('id')->on('accidents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ship_types', function (Blueprint $table) {
            $table->dropForeign('fk_accident_protect');
            $table->dropColumn('fk_accident_protect');
        });
    }
}
