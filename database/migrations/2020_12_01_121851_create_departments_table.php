<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id('idDepartment');
            $table->string('dTitle')->unique();
            $table->timestamps();
        });

        DB::table('departments')->insert([
            'dTitle' => 'KP CES',
        ]);
        DB::table('departments')->insert([
            'dTitle' => 'undefined',
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
