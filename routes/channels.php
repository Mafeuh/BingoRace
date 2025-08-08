<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('room.{roomId}', function($user, $roomId) {
    return true;
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
