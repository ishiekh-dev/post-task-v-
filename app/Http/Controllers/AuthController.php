<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials. 
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); 
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        } 
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User 
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token) 
     */
    public function logout()
    {
        $this->guard()->logout(); 
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token. 
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure. 
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication. 
     */
    public function guard()
    {
        return Auth::guard();
    }
}