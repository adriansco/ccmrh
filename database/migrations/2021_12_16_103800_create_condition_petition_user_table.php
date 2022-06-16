<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionPetitionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condition_petition_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('condition_id')
                ->nullable()
                ->constrained('conditions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('petition_id')
                ->nullable()
                ->constrained('petitions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('comment', 255);
            $table->date('date_change');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condition_petition_user');
    }
}
