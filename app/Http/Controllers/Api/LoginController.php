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
       Auth::attempt(
           $request->only('email', 'password'), $request->boolean('remember')
        );

        //dd($request->user());
        $token =  $request->user()->createToken($request->user()->name);
        return response()->json(['token' => $token->plainTextToken, 'user' => $request->user()]); 

    }
}
