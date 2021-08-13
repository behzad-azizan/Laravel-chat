<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message_id' => $this->message_id,
            'sender' => new ChatResource($this->sender),
            'recipient' => new ChatResource($this->recipient),
            'message' => $this->message,
            'seen_status' => $this->seen_status,
            'send_at' => $this->created_at
        ];
    }
}
