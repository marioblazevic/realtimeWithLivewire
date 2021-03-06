<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use App\Events\Chat\MessageAdded;

class NewMessage extends Component
{
    public $body = "";
    public $room;

    public function send()
    {
        $message = $this->room->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->body
        ]);

        $this->emit('message.added', $message->id);

        // toOthers() zato sto vec sa emit() sami sebi prikazemo u realtime
        broadcast(new MessageAdded($this->room, $message))->toOthers();

        $this->body = "";
        
    }

    public function render()
    {
        return view('livewire.chat.new-message');
    }
}
