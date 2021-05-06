<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Group\CreateGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Group::class)) {
            abort(403, 'Unauthorized');
        }

        $groups = Group::all('idGroup', 'gName');

        return view('userArea.groups.groups', [
            'Group' => self::class,
            'groups' => $groups,
            'title' => 'Групи'
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Group::class)) {
            abort(403, 'Unauthorized');
        }

        return view('userArea.groups.createGroup', [
            'title' => 'Створити групу'
        ]);
    }

    /**
     * store
     *
     * @return void
     */
    public function store(CreateGroupRequest $request)
    {
        $newGroup = Group::create([
            'gName' => $request->gName,
            'gCreateFile' => $request->createFile or 0,
            'gReadFile' => $request->readFile or 0,
            'gUpdateFile' => $request->updateFile or 0,
            'gDeleteFile' => $request->deleteFile or 0,
            'gCreateUser' => $request->createUser or 0,
            'gReadUser' => $request->readUser or 0,
            'gUpdateUser' => $request->updateUser or 0,
            'gDeleteUser' => $request->deleteUser or 0,
            'gCreateGroup' => $request->createGroup or 0,
            'gReadGroup' => $request->readGroup or 0,
            'gUpdateGroup' => $request->updateGroup or 0,
            'gDeleteGroup' => $request->deleteGroup or 0,
            'gCanViewTask' => $request->viewTask or 0,
            'gCanCreateTask' => $request->createTask or 0,
            'gCanAcceptTask' => $request->acceptTask or 0,
            'gCanCancelTask' => $request->cancelTask or 0,
            'gCanPerformTask' => $request->performTask or 0,
            'gCanHistoryTask' => $request->historyTask or 0,
            'gCanStatusTask' => $request->statusTask or 0,
            'gCanPageTask' => $request->pageTask or 0,
            'gCanDescriptionTask' => $request->descriptionTask or 0,
            'gCreateDepartment' => $request->createDepartment or 0,
            'gReadDepartment' => $request->readDepartment or 0,
            'gUpdateDepartment' => $request->updateDepartment or 0,
            'gDeleteDepartment ' => $request->deleteDepartment or 0,
        ]);

        return  redirect(route('groups'));
    }

    /**
     * show
     * @return void
     */
    public function show(Group $group, Request $request)
    {
        if ($request->user()->cannot('view', Group::class)) {
            abort(403, 'Unauthorized');
        }

        return view('userArea.groups.showGroup', [
            'group' => $group,
            'title' => 'Переглянути'
        ]);
    }

    /**
     * edit
     *
     * @return void
     */
    public function edit(Group $group, Request $request)
    {
        if ($request->user()->cannot('update', User::class)) {
            abort(403, 'Unauthorized');
        }
        return view(
            'userArea.groups.editGroup',
            [
                'group' => $group,
                'title' => 'Редагувати групу - ' . $group->gName,
            ]
        );
    }

    /**
     * update
     *
     * @return void
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group = Group::find($group->idGroup);

        if ($request->has('gName')) {
            $group->gName = $request->gName;
        }

        $input = $request->except(['_token', '_method', 'gName', 'groupEditSend']);
        foreach ($input as $key => $value) {
            $group->$key = checkboxToBoolean($value);
        }

        $group->save();

        return redirect(route('groups.edit', $group->idGroup));
    }

    /**
     * destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {
        if ($request->user()->cannot('delete', User::class)) {
            abort(403, 'Unauthorized');
        }

        $undefinedIdGroup = Group::where('gName', 'undefined')->first();
        //Move destroy group users to other group ex. 'undefined'
        foreach (Group::find($request->groupId)->users as $userGroup) {
            $userGroup->uGroup = $undefinedIdGroup->idGroup;
            $userGroup->save();
        }
        Group::destroy($request->groupId);
        return  redirect(route('groups'));
    }





    public static function getCountUserGroup($idGroup)
    {
        $group = new Group();
        return $group->find($idGroup)->users()->count();
    }

    public static function getNameGroup($idGroup)
    {
        return Group::find($idGroup)->gName;
    }
}
