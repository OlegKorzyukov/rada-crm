<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id('idFile');
            $table->string('fName')->unique();
            $table->string('fOriginName');
            $table->unsignedBigInteger('fCreator');
            $table->unsignedBigInteger('fTask');
            $table->unsignedFloat('fSize', 255, 2);
            $table->string('fType');
            $table->timestamp('fDelete',  $precision = 0)->nullable();
            $table->string('fLink');
            $table->timestamps();

            $table->foreign('fCreator')->references('idUser')->on('users');
            $table->foreign('fTask')->references('idTask')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
