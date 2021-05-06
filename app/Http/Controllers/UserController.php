<?php



namespace App\Http\Controllers;



use App\Http\Requests\User\CreateUserRequest;

use App\Http\Requests\User\UpdateUserRequest;

use App\Models\Group;

use App\Models\Department;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;



class UserController extends Controller

{



    /**

     * index

     *

     * @param  mixed $request

     * @return void

     */

    public function index(Request $request)

    {

        if ($request->user()->cannot('viewAny', User::class)) {

            abort(403, 'Unauthorized');
        }



        $users = User::all('idUser', 'uName', 'uLogin', 'uGroup', 'uStatus', 'uActive', 'uPosition', 'uDepartment');



        return view('userArea.users.Users', [

            'users' => $users,

            'title' => 'Користувачі'

        ]);
    }



    /**

     * create

     *

     * @param  mixed $request

     * @return void

     */

    public function create(Request $request)

    {

        if ($request->user()->cannot('create', User::class)) {

            abort(403, 'Unauthorized');
        }

        return view('userArea.users.createUser', [

            'title' => 'Створити користувача',

            'group' => $this->getAllGroup(),

            'department' => $this->getAllDepartment(),

        ]);
    }



    /**

     * store

     *

     * @param  mixed $request

     * @return void

     */

    public function store(CreateUserRequest $request)

    {

        $userLogin = Str::slug($request->uLogin);



        $this->createUserDir($request->uLogin);

        if ($request->file('uAvatar')) {

            $avatarLink = $this->saveUserAvatar($request->file('uAvatar'), $userLogin);
        } else {

            $avatarLink = asset('/images/icons/user.svg');
        }



        $newUser = User::create([

            'uName' => $request->uName,

            'uLogin' => cyrillicToLatin(Str::lower($request->uLogin)),

            'uGroup' => $request->uGroup,

            'uPosition' => $request->uPosition || null,

            'uDepartment' => $request->uDepartment,

            'uAvatar' => $avatarLink,

            'uPass' => $this->createPassUser($request->uPassword)

        ]);



        return  redirect(route('users'));
    }



    /**

     * show

     *

     * @param  mixed $user

     * @param  mixed $request

     * @return void

     */

    public function show(User $user, Request $request)

    {

        if ($request->user()->cannot('view', User::class)) {

            abort(403, 'Unauthorized');
        }

        return view('userArea.users.showUser', [

            'user' => $user,

            'title' => $user->uName

        ]);
    }



    /**

     * edit

     *

     * @param  mixed $user

     * @param  mixed $request

     * @return void

     */

    public function edit(User $user, Request $request)

    {

        if ($request->user()->cannot('update', User::class) or $user->idUser !== Auth::id() and Auth::id() !== 1) {

            abort(403, 'Unauthorized');
        }



        return view(

            'userArea.users.editUser',

            [

                'user' => $user,

                'title' => 'Редагувати користувача - ' . $user->uName,

                'group' => $this->getAllGroup(),

                'department' => $this->getAllDepartment(),

            ]

        );
    }



    /**

     * update

     *

     * @param  mixed $request

     * @param  mixed $user

     * @return void

     */

    public function update(UpdateUserRequest $request, User $user)

    {

        $userLogin = Str::slug($request->uLogin);



        if ($request->uName && $request->uName !== $user->uName) {

            $user->uName = $request->uName;
        }

        if ($request->uGroup && $request->uGroup !== $user->uGroup) {

            $user->uGroup = $request->uGroup;
        }

        if ($request->uPosition && $request->uPosition !== $user->uGroup) {

            $user->uPosition = $request->uPosition;
        }

        if ($request->uDepartment && $request->uDepartment !== $user->uDepartment) {

            $user->uDepartment = $request->uDepartment;
        }

        if ($request->file('uAvatar') !== null) {

            $avatarLink = $this->saveUserAvatar($request->file('uAvatar'), $userLogin);

            $user->uAvatar = $avatarLink;
        }

        if ($request->uPassword) {

            $user->uPass = $this->createPassUser($request->uPassword);
        }



        $user->save();



        return redirect(route('users'));
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



        $getUser = User::find($request->userId);

        $this->removeUserDir($getUser);

        User::destroy($request->userId);



        return  redirect(route('users'));
    }





    private function saveUserAvatar($avatar, $avatarName)

    {

        $ratioFile = getimagesize($avatar->getLinkTarget());

        $originNameFile = $avatar->getClientOriginalName();

        $mimeFile = $avatar->getMimeType();

        $sizeFile = $avatar->getSize();

        $extensionFile = $avatar->extension();



        $saveAvatar = $avatar->storeAs('avatars', $avatarName . 'Avatar.' . $extensionFile);

        $avatarLink =   asset('/storage/' . $saveAvatar); //Storage::url($saveAvatar);



        return $avatarLink;
    }



    private function createUserDir($userLogin)

    {

        Storage::makeDirectory('/avatars');

        Storage::makeDirectory('/tasks/' . Str::slug($userLogin));

        Storage::disk('local')->makeDirectory('/logs/' . Str::slug($userLogin));
    }



    private function removeUserDir($user)

    {

        $avatarFile = basename($user->uAvatar);

        Storage::deleteDirectory('/tasks/' . $user->uLogin);

        Storage::disk('local')->deleteDirectory('/logs/' . $user->uLogin);

        Storage::delete('avatars/' . $avatarFile);
    }



    public static function getGroupLoginUser()

    {

        return User::find(Auth::id())->group;
    }



    public function getAllGroup()

    {

        return Group::all('idGroup', 'gName')

            ->where('gName', '!==', 'superuser');
    }



    public function getAllDepartment()

    {

        return Department::all('idDepartment', 'dTitle');
    }



    public static function createPassUser(string $password): string

    {

        return Hash::make($password);
    }
}
