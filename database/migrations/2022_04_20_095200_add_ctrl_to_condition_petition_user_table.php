<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCtrlToConditionPetitionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condition_petition_user', function (Blueprint $table) {
            $table->enum("ctrl", ["0", "1"])
                ->after('comment'); // <-- Aquí el enum
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condition_petition_user', function (Blueprint $table) {
            $table->dropColumn('ctrl');
        });
    }
}
