<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email']
        ]);

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('API Token')->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => $user
        ], ['Access-Token' => $token]);
    }

    public function login(LoginUserRequest $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Credentials do not match', 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('API Token')->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => $user
        ], ['Access-Token' => $token]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function success($data, $headers = [])
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200, $headers);
    }

    public function error($message, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
