<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('idTask');
            $table->char('tNumber', 8)->unique();
            $table->string('tSignName');
            $table->boolean('tStatus');
            $table->unsignedBigInteger('tInitiator');
            $table->string('tInitiatorAdditional')->nullable();
            $table->unsignedBigInteger('tAcceptChief')->nullable();
            $table->unsignedBigInteger('tExecutor')->nullable();
            $table->text('tDescription')->nullable();
            $table->date('tCreateTime');
            $table->timestamp('tChiefAcceptTime', $precision = 0)->nullable();
            $table->timestamp('tCloseTime', $precision = 0)->nullable();
            $table->timestamp('tExecutorGetDate')->nullable();
            $table->timestamp('tCancelTime', $precision = 0)->nullable();
            $table->unsignedBigInteger('tCancelInitiator')->nullable();
            $table->unsignedInteger('tWorkTime')->nullable();
            $table->unsignedInteger('tPage');
            $table->string('tSitePath');
            $table->string('tSiteLink')->nullable();
            $table->string('tLink')->nullable();
            $table->timestamps();

            $table->foreign('tInitiator')->references('idUser')->on('users');
            $table->foreign('tAcceptChief')->references('idUser')->on('users');
            $table->foreign('tExecutor')->references('idUser')->on('users');
            $table->foreign('tCancelInitiator')->references('idUser')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
