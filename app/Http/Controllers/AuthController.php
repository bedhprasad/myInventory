<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    // }

    public function register(Request $request){
        // $valid_data = request()->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'password_confirmation' => 'required',
        // ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->password_confirmation = $request->password_confirmation;
        // dd('$user');

        // return redirect()->to('register');
        return view('auth/register');

    }

    public function logout(Request $request){
        //session destroy code here
        // dd($request->session()->all());
        // $request->session()->destroy();
        Session::flush();
        // dd($data);
        return redirect('/home');
    }
}
