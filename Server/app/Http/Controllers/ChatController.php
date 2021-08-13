<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class ChatController extends BaseController
{
    public function index()
    {
        $users = UserRepository::getInstance()
            ->list()
            ->whereNotIn('id', [Auth::id()])
            ->get();

        return $this->successResponse([
            'chats' => ChatResource::collection($users)
        ]);
    }
}
