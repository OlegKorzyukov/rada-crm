<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;

use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Session;

class AuthenticatedSessionController extends Controller

{

    /**

     * Display the login view.

     *

     * @return \Illuminate\View\View

     */

    public function create()

    {

        return view('auth.login');
    }



    /**

     * Handle an incoming authentication request.

     *

     * @param  \App\Http\Requests\Auth\LoginRequest  $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function store(LoginRequest $request)

    {

        $request->authenticate();

        $this->checkSessionOnce(Auth::id());

        $request->session()->regenerate();

        $this->setOnlineStatus(1);

        return redirect(RouteServiceProvider::HOME);
    }



    protected function setOnlineStatus(int $statusCode)

    {

        $user = User::find(Auth::id());

        $user->uStatus = $statusCode;

        $user->save();
    }



    private function checkSessionOnce($userId)

    {

        $sessionUser = Session::all()->where('user_id', $userId)->first();

        if (!is_null($sessionUser)) {

            $sessionUser->delete();
        }
    }



    /**

     * Destroy an authenticated session.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function destroy(Request $request)

    {

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $this->setOnlineStatus(0);



        return redirect('/');
    }
}
