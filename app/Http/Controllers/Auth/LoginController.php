<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void$field
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
     *  Login with Username or Email
     * */
    // public function username()
    // {
    //     $identity = request()->identity;
    //     $temp = explode("@", $identity);
    //     $field = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    //     if($field!="email"){
    //         if(is_array($temp)){
    //             request()->merge([$field => $temp[0]]);
    //         }else{
    //             request()->merge([$field => $identity]);
    //         }
    //     }
    //     else
    //         request()->merge([$field => $identity]);
    //     return $field;
    // }
    // public function authenticate(Request $request)
    // {
    //     if (Auth::user()) {
    //         return redirect()->intended('dashboard');
    //     }else{
    //         return redirect('/login')->with('password', 'Password fail');
    //     }
    // }
    public function login(Request $request)
    {
        $input = $request->all();

        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // $temp = expload("@", $input['identity']);
        // if(is_array($temp)){
        //     $flag  = 0;
        //     $identity = $temp;
        // }else{
        //     $flag = 1;
        //     $identity = $temp[0];
        // }
        if(auth()->attempt(array('email' => $input['identity'], 'password' => $input['password'])))
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('login')
                ->withErrors(['password'=>"Your password is incorrect. If you have forgotten your password.", 'identity'=>$input['identity']]);
        }
        // if($flag = 0){
        //     if(auth()->attempt(array('email' => $identity, 'password' => $input['password'])))
        //     {
        //         return redirect()->route('home');
        //     }else{
        //         return redirect()->route('login')
        //             ->with('error','Email-Address And Password Are Wrong.');
        //     }

        // }else{
        //     if(auth()->attempt(array('name' => $identity, 'password' => $input['password'])))
        //     {
        //          return redirect()->route('home');
        //     }else{
        //         return redirect()->route('login')
        //             ->with('error','Email-Address And Password Are Wrong.');
        //     }
        // }


    }

}
