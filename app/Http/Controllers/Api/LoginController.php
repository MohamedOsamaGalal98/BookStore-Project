<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $guard = '';

        if(request()->guard == 'author') {
            $guard = 'authors';

        }
        //dd($guard);

        Auth::guard($guard)->attempt(
           $request->only('email', 'password'), $request->boolean('remember')
        );
        //dd(Auth::guard($guard)->user());
        $token =  Auth::guard($guard)->user()->createToken(Auth::guard($guard)->user()->name);
        return response()->json(['token' => $token->plainTextToken, 'user' => Auth::guard($guard)->user()]); 

    }
}
