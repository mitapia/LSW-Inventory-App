<?php

namespace App\Http\Controllers\Auth;

use Gate;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/dashboard';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given username.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function getReset($username)
    {
        // Auth check, only owner and Admin can reset password
        if (Gate::allows('owns-user', $username) || Gate::allows('admin')) {
            $user = User::where('username', $username)->firstOrFail();

            $page = 'settings';
            return view('auth.reset', compact('username', 'page'));                
        }
        // Not authorized error
        // Forbidden
        abort(403, 'Access denied, you do not have privileges to edit this user');
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        // Auth check, only owner and Admin can reset password
        if (Gate::allows('owns-user', $request->username) || Gate::allows('admin')) {

            $this->validate($request, [
                'username' => 'required|exists:users,username',
                'password' => 'required|confirmed|min:6',
            ]);

            $user = User::where('username', '=', $request->username)->firstOrFail();
            $this->resetPassword($user, $request->password);

            return  redirect('dashboard');
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();
    }

}
