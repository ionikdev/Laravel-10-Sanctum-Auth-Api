<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\HttpResponses;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use HttpResponses;
    public function register(RegisterRequest $request){
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request ->email,
            'gender' => $request ->gender,
            'phone_number' => $request ->phone_number,
            'country' => $request ->country,
            'password'=>Hash::make($request->password),
        ]);

        return $this->success([
            'user'=> $user,
            'token'=> $user->createToken('API Token of '. $user->name)->plainTextToken
        ]);
    }

    public function login(LoginRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('', 'Credentials do not match', 401);
        }
        
        $user= User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('ApiTokenof')->plainTextToken
        ]);      
    }
    public function logout()
    {
        return response()->json(['message' => 'Logout successful']);
    }
    
}