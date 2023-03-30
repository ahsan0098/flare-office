<?php

namespace App\Http\Livewire\Employe;

use Livewire\Component;
use App\Models\PublicChat;

class EmployePublicChat extends Component
{
    public $test = "ahsan";
    public $me;
    public $other = null;
    public $public_chat;
    public $public_message;
    public function mount()
    {
        $this->me = session()->get('u_id');
        $this->public_chat = PublicChat::with('sender')->get();
    }

    public function booted()
    {
        $this->public_chat = PublicChat::with('sender')->get();
        // $this->public_chat = json_decode($this->public_chat, true);
    }
    public function publicSend()
    {
        if ($this->public_message != '') {
            $send = new PublicChat;
            $send->sender_id = $this->me;
            $send->message = $this->public_message;
            if ($send->save()) {
                $this->public_message = '';
            }
        }
    }
    public function render()
    {
        return view('livewire.employe.employe-public-chat')->layout('layouts.user-base');
    }
}
