<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\CustomException;

class AuthRepository
{
    public function register($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        Session::put('token', $token);

        return response()->json([
            'message' => 'User created',
            'token' => $token,
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate($request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            throw new CustomException("Error:  Login failed");
        } else {
            Session::put('token', $token);

            return response()->json([
                'token' => $token,
                'user' => Auth::user()
            ]);
        }
    }

    public function logout($request)
    { 
        $access_token = str_replace('Bearer ', '', $request->header('Authorization'));
        $token = JWTAuth::invalidate($access_token);

        if (!$token)
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);

        return response()->json([
            'success' => true,
            'message' => 'User disconnected'
        ]);
    }
    
    public function getDataUser($request)
    {
        $access_token = str_replace('Bearer ', '', $request->header('Authorization'));
        $user = JWTAuth::authenticate($access_token);

        if (!$user)
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);

        return response()->json(['user' => $user]);
    }
}
