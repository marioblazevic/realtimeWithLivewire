<?php

namespace App\Http\Livewire\Chat;

use App\Models\Room;
use Livewire\Component;

class Users extends Component
{
    public $roomId;

    public $users;

    public function mount(Room $room)
    {
        $this->roomId = $room->id;
    }

    public function getListeners()
    {
        return [
            "echo-presence:chat.{$this->roomId},here" => 'setUsersHere',
            "echo-presence:chat.{$this->roomId},joining" => 'setUserJoining',
            "echo-presence:chat.{$this->roomId},leaving" => 'setUserLeaving'
        ];
    }
    
    // Laravel Doc. Joining Presence Channels, procitaj
    // here vraca sve korisnike na kanalu
    public function setUsersHere($users)
    {
        //  nasoj promenljivoj $users dodeljujemo korisnike iz here
        $this->users = $users;
    }

    //  joining vraca onog ko je usao
    public function setUserJoining($user)
    {
        $this->users[] = $user;
    }

    public function setUserLeaving($user)
    {
        $this->users = array_filter($this->users, function($u) use ($user){
            return $u['id'] != $user['id'];
            // vratimo sve korisnike koji su razliciti korisniku koji je napustio..
        });
    }

    public function render()
    {
        return view('livewire.chat.users');
    }
}
