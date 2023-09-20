<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
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
    return (int) $user->id === (int) $id;
});
Broadcast::channel('private.chat.{id}', function ($user, $id){
    return true;
});
Broadcast::channel('user.{userId}', function (User $user, $userId) {

    return intval($user->id) === intval($userId);

});
Broadcast::channel('admin.channel', function ($user) {

    return $user->hasPermissions('administration');

});
