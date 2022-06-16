<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupToPetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petitions', function (Blueprint $table) {
            /* $table->foreignId('group_id')->after('compensated')
                ->nullable()
                ->constrained('groups')
                ->cascadeOnUpdate()
                ->nullOnDelete(); */
            $table->string('group_code')->nullable();
            $table->foreign('group_code')
                ->references('code')
                ->on('groups')
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
            $table->dropForeign(['group_code']);
            $table->dropColumn('group_code');
        });
    }
}
