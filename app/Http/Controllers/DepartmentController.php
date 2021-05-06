<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Department::class)) {
            abort(403, 'Unauthorized');
        }

        $departments = Department::all('idDepartment', 'dTitle');

        return view('userArea.departments.departments', [
            'title' => 'Департаменти',
            'departments' => $departments,
            'Department' => self::class,
        ]);
    }

    public function store(CreateDepartmentRequest $request)
    {
        $newDepartment = Department::create([
            'dTitle' => $request->dTitle,
        ]);
        return  redirect(route('departments'));
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Department::class)) {
            abort(403, 'Unauthorized');
        }
        return view('userArea.departments.createDepartment', [
            'title' => 'Створити департамент',
        ]);
    }

    public function show(Request $request)
    {
        if ($request->user()->cannot('viewAny', Department::class)) {
            abort(403, 'Unauthorized');
        }
        return view('userArea.departments.showDepartment', [
            'title' => 'Інформація про департамент',
        ]);
    }

    public function edit(Department $department, Request $request)
    {
        if ($request->user()->cannot('update', Department::class)) {
            abort(403, 'Unauthorized');
        }
        return view(
            'userArea.departments.editDepartment',
            [
                'department' => $department,
                'title' => 'Редагувати групу - ' . $department->dTitle,
            ]
        );
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department = Department::find($department->idDepartment);

        if ($request->has('dTitle')) {
            $department->dTitle = $request->dTitle;
        }
        $department->save();

        return redirect(route('departments.edit', $department->idDepartment));
    }

    public function destroy(Request $request)
    {
        if ($request->user()->cannot('delete', Department::class)) {
            abort(403, 'Unauthorized');
        }

        $undefinedIdDepartment = Department::where('dTitle', 'undefined')->first();
        //Move destroy department users to other group ex. 'undefined'
        foreach (Department::find($request->departmentId)->users as $userDepartment) {
            $userDepartment->uDepartment = $undefinedIdDepartment->idDepartment;
            $userDepartment->save();
        }
        Department::destroy($request->departmentId);
        return  redirect(route('departments'));
    }



    public function getDepartmentTask()
    {
        return Department::all('dTitle')
            ->where('dTitle', '!==', 'KP CES');
    }

    public function getAjaxDepartment(Request $request)
    {
        if ($request->get('req') === 'getDepartmentInfo') {
            return response()->json($this->getDepartmentTask(), 200);
        }
    }

    public static function getNameDepartament($idDepartment)
    {
        return Department::find($idDepartment)->dTitle;
    }

    public static function getCountUserDepartment($idDepartment)
    {
        $department = new Department();
        return $department->find($idDepartment)->users()->count();
    }

    public function getAjaxUserAll(Request $request, Department $department)
    {
        if ($request->get('req') === 'getUserList') {
            $department = $department->all()
                ->where('dTitle', '!==', 'KP CES')
                ->where('dTitle', '!==', 'undefined');
            $allUserDepartment = [];
            foreach ($department as $key => $value) {
                $countUser = $department->find($value->idDepartment)->users->count();
                if ($countUser !== 0) {
                    $allUserDepartment[$value->dTitle] = $department->find($value->idDepartment)->users;
                }
            }
            return response()->json($allUserDepartment, 200);
        }
    }
}


/*
            ['title' => 'Патронатна служба'],
            ['title' => 'Організаційний відділ'],
            ['title' => 'Відділ документообігу, контролю та забезпечення діяльності керівництва'],
            ['title' => 'Юридичний відділ'],
            ['title' => 'Відділ з питань персоналу'],
            ['title' => 'Відділ фінансового забезпечення'],
            ['title' => 'Відділ інформації та зв’язків з громадськістю'],
            ['title' => 'Управління з питань аналізу бюджету та регіональних програм'],
            ['title' => 'Відділ аналізу регіональних програм'],
            ['title' => 'Відділ аналізу доходів місцевих бюджетів'],
            ['title' => 'Управління розвитку об’єктів спільної власності територіальних громад області'],
            ['title' => 'Відділ правового забезпечення'],
            ['title' => 'Відділ обліку майна та орендних відносин'],
            ['title' => 'Відділ контролю за ефективністю використання об’єктів спільної власності'],
        */