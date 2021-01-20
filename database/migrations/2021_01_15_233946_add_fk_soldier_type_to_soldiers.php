<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkSoldierTypeToSoldiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soldiers', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_soldier_type');
            $table->foreign('fk_soldier_type')->references('id')->on('soldier_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soldiers', function (Blueprint $table) {
            $table->dropForeign('fk_soldier_type');
            $table->dropColumn('fk_soldier_type');
        });
    }
}
