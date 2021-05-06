<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id('idGroup');
            $table->string('gName')->unique();
            $table->boolean('gCreateFile')->default(0);
            $table->boolean('gReadFile')->default(0);
            $table->boolean('gUpdateFile')->default(0);
            $table->boolean('gDeleteFile')->default(0);
            $table->boolean('gCreateUser')->default(0);
            $table->boolean('gReadUser')->default(0);
            $table->boolean('gUpdateUser')->default(0);
            $table->boolean('gDeleteUser')->default(0);
            $table->boolean('gCreateGroup')->default(0);
            $table->boolean('gReadGroup')->default(0);
            $table->boolean('gUpdateGroup')->default(0);
            $table->boolean('gDeleteGroup')->default(0);
            $table->boolean('gCanViewTask')->default(0);
            $table->boolean('gCanCreateTask')->default(0);
            $table->boolean('gCanAcceptTask')->default(0);
            $table->boolean('gCanCancelTask')->default(0);
            $table->boolean('gCanPerformTask')->default(0);
            $table->boolean('gCanHistoryTask')->default(0);
            $table->boolean('gCanStatusTask')->default(0);
            $table->boolean('gCanPageTask')->default(0);
            $table->boolean('gCanDescriptionTask')->default(0);
            $table->boolean('gCreateDepartment')->default(0);
            $table->boolean('gReadDepartment')->default(0);
            $table->boolean('gUpdateDepartment')->default(0);
            $table->boolean('gDeleteDepartment')->default(0);
            $table->boolean('gSettingsApp')->default(0);
            $table->boolean('gViewUserAction')->default(0);
            $table->timestamps();
        });

        DB::table('groups')->insert([
            'gName' => 'superuser',
            'gCreateFile' => 1,
            'gReadFile' => 1,
            'gUpdateFile' => 1,
            'gDeleteFile' => 1,
            'gCreateUser' => 1,
            'gReadUser' => 1,
            'gUpdateUser' => 1,
            'gDeleteUser' => 1,
            'gCreateGroup' => 1,
            'gReadGroup' => 1,
            'gUpdateGroup' => 1,
            'gDeleteGroup' => 1,
            'gCanViewTask' => 1,
            'gCanCreateTask' => 1,
            'gCanAcceptTask' => 1,
            'gCanCancelTask' => 1,
            'gCanPerformTask' => 1,
            'gCanHistoryTask' => 1,
            'gCanStatusTask' => 1,
            'gCanPageTask' => 1,
            'gCanDescriptionTask' => 1,
            'gCreateDepartment' => 1,
            'gReadDepartment' => 1,
            'gUpdateDepartment' => 1,
            'gDeleteDepartment' => 1,
            'gSettingsApp' => 1,
            'gViewUserAction' => 1
        ]);

        DB::table('groups')->insert([
            'gName' => 'undefined',
            'gCreateFile' => 0,
            'gReadFile' => 0,
            'gUpdateFile' => 0,
            'gDeleteFile' => 0,
            'gCreateUser' => 0,
            'gReadUser' => 0,
            'gUpdateUser' => 0,
            'gDeleteUser' => 0,
            'gCreateGroup' => 0,
            'gReadGroup' => 0,
            'gUpdateGroup' => 0,
            'gDeleteGroup' => 0,
            'gCanViewTask' => 0,
            'gCanCreateTask' => 0,
            'gCanAcceptTask' => 0,
            'gCanCancelTask' => 0,
            'gCanPerformTask' => 0,
            'gCanHistoryTask' => 0,
            'gCanStatusTask' => 0,
            'gCanPageTask' => 0,
            'gCanDescriptionTask' => 0,
            'gCreateDepartment' => 0,
            'gReadDepartment' => 0,
            'gUpdateDepartment' => 0,
            'gDeleteDepartment' => 0,

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
