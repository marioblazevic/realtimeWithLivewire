<?php

namespace App\Http\Livewire\Chat;

use App\Models\Room;
use App\Models\Message;
use Livewire\Component;

class Messages extends Component
{
    public $messages;
    // $roomId dodeljujemo Id od room
    public $roomId;

    // Osluskujemo event iz NewMessage i pozivamo metod prepend message, parametar mora u zagradu za prependMessage($id)
    // protected $listeners = ['message.added' => 'prependMessage'];

    public function mount(Room $room, $messages)
    {
        $this->roomId = $room->id;
        $this->messages = $messages;
    }

    // isto kao gore samo preko metoda
    public function getListeners()
    {
        return [
            'message.added' => 'prependMessage',
            "echo-private:chat.{$this->roomId},Chat\\MessageAdded" => 'prependMessageFromBroadcast'
        ];
    }

    // realtime samo za nas
    public function prependMessage($id)
    {
        $this->messages->prepend(Message::find($id));
    }

    // $payload nam salje podatke iz konstruktora
    public function prependMessageFromBroadcast($payload)
    {
        $this->prependMessage($payload['message']['id']);
    }

    public function render()
    {
        return view('livewire.chat.messages');
    }
}
