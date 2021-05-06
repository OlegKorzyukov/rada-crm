<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\FileController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\GroupController;

use App\Http\Controllers\TaskController;

use App\Http\Controllers\MenuController;

use App\Http\Controllers\DepartmentController;



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/





/*

Route::domain('{company_name}.workspace.com')->group(function () {

    Route::get('users', 'UsersController@index');

});



MULTISITE



*/





//index  get   -- /articles

//store  post   -- /articles

//create  get   -- /articles/create

//show   get    -- /articles/{article}

//edit   get    -- /articles/{article}/edit

//update  put   -- /articles/{article}

//destroy  DELETE --/articles/{article}/delete @DELETE


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {

        return view('userArea/dashboard', ['title' => 'Статистика']);
    })->name('dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



    /* ---------------------------------- User ---------------------------------- */

    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');

    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');



    /* ---------------------------------- Group --------------------------------- */

    Route::get('/groups', [GroupController::class, 'index'])->name('groups');

    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');

    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');

    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');

    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');

    Route::put('/groups/{group}/update', [GroupController::class, 'update'])->name('groups.update');

    Route::delete('/groups', [GroupController::class, 'destroy'])->name('groups.destroy');



    /* ---------------------------------- Tasks --------------------------------- */

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

    Route::put('/tasks/{task}/update', [TaskController::class, 'update'])->name('tasks.update');



    Route::post('/task/files/upload', [FileController::class, 'uploadTaskFiles'])->name('task.upload.file');

    Route::post('/tasks/download', [FileController::class, 'compressFiles'])->name('tasks.files');



    /* ------------------------------- Department ------------------------------- */

    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');

    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');

    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');

    Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');

    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');

    Route::put('/departments/{department}/update', [DepartmentController::class, 'update'])->name('departments.update');

    Route::delete('/departments', [DepartmentController::class, 'destroy'])->name('departments.destroy');



    Route::post('/departments/all', [DepartmentController::class, 'getAjaxDepartment'])->name('departments.all');

    Route::post('/departments/all/users', [DepartmentController::class, 'getAjaxUserAll'])->name('departments.all.user');



    /* ---------------------------------- API Menu ---------------------------------- */

    Route::post('/task/menus', [MenuController::class, 'getAjaxMenu'])->name('task.menu');
});





Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/', [AuthenticatedSessionController::class, 'store']);
});
