<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }

    public function ProsesLogin(Request $request){
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credencil = $request->only('email', 'password');
        if(Auth::attempt($credencil)){
            $user = Auth::user();
            if($user->role != '' || $user->role != null){
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('/');
        }
        return redirect('login');
    }

    public function dashboard(){
        return view('master_layout.dashbord');
    }

    public function logout(Request $request){
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}