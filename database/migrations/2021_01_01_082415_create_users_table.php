<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('idUser');
            $table->string('uName');
            $table->string('uLogin')->unique();
            $table->string('uPass');
            $table->unsignedBigInteger('uGroup');
            $table->string('uAvatar')->default('/images/icons/user.svg');
            $table->boolean('uStatus')->default(0);
            $table->boolean('uActive')->default(1);
            $table->string('uPosition')->default('');
            $table->unsignedBigInteger('uDepartment');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('uGroup')->references('idGroup')->on('groups');
            $table->foreign('uDepartment')->references('idDepartment')->on('departments');
        });

        DB::table('users')->insert([
            'uName' => env('SUPERADMIN_APP_USERNAME', 'null'),
            'uLogin' => env('SUPERADMIN_APP_LOGIN', 'null'),
            'uPass' => App\Http\Controllers\UserController::createPassUser(env('SUPERADMIN_APP_PASS', 'null')),
            'uGroup' => 1,
            'uPosition' => 'СуперАдміністратор',
            'uDepartment' => 1,

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
