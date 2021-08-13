<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    Log::debug(request());
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{toUserId}', function ($user, $toUserId) {
    return $user->id == $toUserId;
});
Broadcast::channel('chat', function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->name
    ];
});
