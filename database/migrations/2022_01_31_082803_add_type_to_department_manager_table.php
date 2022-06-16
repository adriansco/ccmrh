<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToDepartmentManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_manager', function (Blueprint $table) {
            $table->enum("type", ["Supervisor", "Jefe", "Gerente"])->nullable()->after('employee_id');// <-- Aquí el enum
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department_manager', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
