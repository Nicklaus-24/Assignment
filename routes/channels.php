<?php

use Illuminate\Support\Facades\Broadcast;

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

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat', function ($user) {
    if (Auth::guard('admin')->check()) {
        // Check if the user is authenticated as an admin
        return ['id' => $user->id, 'admin' => true];
    } else {
        // Check if the user is authenticated as a regular user
        return ['id' => $user->id, 'admin' => false];
    }
});

