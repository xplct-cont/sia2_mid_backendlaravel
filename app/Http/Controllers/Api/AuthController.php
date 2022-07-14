<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'lname' => 'string|required',
            'fname' => 'string|required',
            'course' => 'string|required',
            'year' => 'string|required',
            'address' => 'string|required',
            'mobile' => 'string|required',
            'password' => 'string|required',
            'email' => 'email|required',

        ]);

        $user = User::create([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'course' => $request->course,
            'year' => $request->year,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

       

        $token = $user->createToken("API")->plainTextToken;

        return response()->json([
            'status'=>'success',
            'message'=>'User registered successfully',
            'user' => $user,
            'token' => $token,
            
        ]);
    }


    public function login(Request $request) {
        $request->validate([
            'email'=>'email|required',
            'password'=>'string|required'
        ]);

        $login = auth()->attempt($request->only('email','password'));

        if(!$login) {
            return response()->json([
                'status'=>'error',
                'message'=>'Invalid user credentials'
            ],);
        }

        $user = auth()->user();

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'status'=>'success',
            'message'=>'Logged in successfully',
            'user' => $user,
            'token'=>$token,
            
        ]);
    }

    public function user() {
        return auth()->user();
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'User has been logged out.'
        ]);
    }
}