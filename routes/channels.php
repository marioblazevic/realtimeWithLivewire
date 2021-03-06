<?php

use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('chat.{roomId}', function ($user) {
    
    return Arr::only($user->toArray(), [
        'id',
        'name'
    ]);

});
