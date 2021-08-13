<?php


namespace App\Repositories\Message;


use App\Http\Requests\SendMessageRequest;
use App\Models\Message;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageRepository extends BaseRepository
{
    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getMessages(array $params = [])
    {
        $query = Message::query();

        if (isset($params['recipient_id']))
            $query->where('recipient_id', $params['recipient_id']);

        return $query;
    }

    public function seenMessages()
    {
        DB::table('messages')
            ->where('recipient_id', Auth::id())
            ->update([
                'seen_at' => Carbon::now()->toDateTimeString()
            ]);
    }
}
