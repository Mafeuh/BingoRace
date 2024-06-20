<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('bingo-room', function($user) {
    return true;
});