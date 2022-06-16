<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamPetitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_petition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('exam_id')
                ->nullable()
                ->constrained('exams')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('petition_id')
                ->nullable()
                ->constrained('petitions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('note_id')
                ->nullable()
                ->constrained('notes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            /* $table->enum('status', ['Pending', 'Wait', 'Active'])->default('Pending'); */
            /* $table->enum('status', ['Aprobado', 'No aprobado', 'Aprobado con reservas', 'Pendiente'])->default('Pendiente'); */
            $table->string('feedback', 255);
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_petition');
    }
}
