<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionDestinyToPetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petitions', function (Blueprint $table) {
            $table->unsignedBigInteger('position_destiny_id')->nullable();
            $table->foreign('position_destiny_id')
                ->references('id')
                ->on('positions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petitions', function (Blueprint $table) {
            $table->dropForeign(['position_destiny_id']);
            $table->dropColumn('position_destiny_id');
        });
    }
}
