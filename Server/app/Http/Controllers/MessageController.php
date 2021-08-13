<?php

namespace App\Http\Controllers;

use App\Classes\SendMessage;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Repositories\Message\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends BaseController
{
    public function getMessages($senderId, $recipientId, Request $request)
    {
        $messages = MessageRepository::getInstance()
            ->getMessages($request->all())
            ->conversation($senderId, $recipientId)
            ->with(['sender', 'recipient'])
            ->get();

        return $this->successResponse([
            'messages' => MessageResource::collection($messages)
        ]);
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $message = SendMessage::getInstance()
            ->setRequest($request)
            ->store();

        return $this->successResponse([
            'message' => new MessageResource($message)
        ]);
    }
}
