<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['name', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'code' => 0,
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json([
            'code' => 0,
            'message' => '',
            'data' => [
                'logined' => true,
                'user' => auth('api')->user(),
            ]
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'code' => 0,
            'message' => '退出成功！',
            'data' => null
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'code' => 0,
            'message' => '',
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer'
            ]
        ]);
    }
}
