<?php

namespace App\Http\Controllers;

use App\Classes\Authenticate;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Validation\Rule;

class AuthController extends BaseController
{

    public function login(LoginRequest $request)
    {
        $this->validate($request, [
            'username' => ['required', Rule::exists('users', 'username')],
            'password' => ['required', 'string']
        ], [], [
            'username.exists' => trans('m.user_not_found')
        ]);

        $user = Authenticate\UserLogin::GetInstance()
            ->setRequest($request)
            ->login();

        return $this->successResponse([
            'user' => new UserResource($user),
            'access_token' => $user->createToken('User login')->accessToken
        ]);
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = UserRepository::getInstance()
            ->newUser($request);

        return $this->successResponse([
            'user' => new UserResource($user)
        ]);
    }
}
