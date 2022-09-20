<?php

namespace App\Http\Controllers;

use App\Models\ThirdPartyPerson;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class AuthThirdController extends Controller
{
    /* public function __construct()
    {
        Config::set('jwt.user', ThirdPartyPerson::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => App\Models\ThirdPartyPerson::class,
        ]]);
    } */
    use ApiResponser;
    /**
     * Login usuario y retornar el token
     * @return token
     */

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('user', 'password');
            $data['usuario'] = $credentials['user'];
            $data['password'] = $credentials['password'];
            if (!$token = JWTAuth::attempt([
                'usuario' => $data['usuario'],
                'password' => $data['password']
            ])) {
                return response()->json(['error' => 'Unauthoriz55ed'], 401);
            }

            return response()->json([
                'status' => 'success', 
                'token' => $this
                    ->respondWithToken($token)], 200)
                    ->header('Authorization', $token)
                    ->withCookie(
                        'token',
                        $token,
                        config('jwt.ttl'),
                        '/'
                    );
        } catch (\Throwable $th) {
            return  $this->errorResponse([$th->getMessage(), $th->getFile(), $th->getLine()]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out Successfully.'
        ], 200);
    }

    /**
     * Obtener el usuario autenticado
     *
     * @return Usuario
     */


    /**
     * Refrescar el token por uno nuevo
     *
     * @return token
     */

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()->json()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

   /*  public function renew()
    {
        try {
            //code...
            if (!$token = $this->guard()->refresh()) {
                return response()->json(['error' => 'refresh_token_error'], 401);
            }

            $user = auth()->user();

            $user = ThirdPartyPerson::with('laboratory')->find($user->id);

            return response()
                ->json(['status' => 'successs', 'token' => $token, 'user' => $user], 200)
                ->header('Authorization', $token);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'refresh_token_error' . $th->getMessage()], 401);
        }
    } */

    public function renew()
    {
        try {
            //code...
            if (!$token = $this->guard()->refresh()) {
                return response()->json(['error' => 'refresh_token_error'], 401);
            }

            $user = auth()->user();

            $user = Usuario::with(
                [
                    'person' => function ($q) {
                        $q->select('*')->with('companies', 'companyWorked');
                    },
                    'permissions' => function ($q) {
                        $q->select('*');
                    },
                    'board' => function ($q) {
                        $q->select('*');
                    },
                    'task' => function ($q) {
                        $q->select('*');
                    },

                ]
            )->find($user->id);

            return response()
                ->json(['status' => 'successs', 'token' => $token, 'user' => $user], 200)
                ->header('Authorization', $token);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'refresh_token_error' . $th->getMessage()], 401);
        }
    }
    /**
     * Retornar el guard
     *
     * @return Guard
     */
    private function guard()
    {
        return Auth::guard();
    }
    protected function respondWithToken($token)
    {
        auth()->factory()->getTTL() * 60;

        return $token;
        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL() * 60
        // ]);
    }
}
