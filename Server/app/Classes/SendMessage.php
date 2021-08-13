<?php


namespace App\Classes;


use App\Events\MessageSent;
use App\Http\Requests\SendMessageRequest;
use App\Models\Message;
use App\Traits\GetInstance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class SendMessage
 * @package App\Classes
 *
 * @method self static GetInstance
 */
class SendMessage
{
    use GetInstance;

    /**
     * @var SendMessageRequest
     */
    protected $request;

    /**
     * @param SendMessageRequest $request
     * @return $this
     */
    public function setRequest(SendMessageRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return Message
     */
    public function store()
    {
        $message = new Message([
            'message' => $this->request->get('message'),
            'recipient_id' => $this->request->get('recipient_id'),
        ]);

        $message->sender_id = $this->getSenderId();
        $message->save();

        broadcast(new MessageSent($message))
            ->toOthers();

        return $message;
    }

    /**
     * @return int|string|null
     */
    protected function getSenderId()
    {
        return Auth::id();
    }
}
