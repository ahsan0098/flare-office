<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\PublicChat;
use App\Models\PrivateChat;

class AdminPublicChat extends Component
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
        return view('livewire.admin.admin-public-chat')->layout('layouts.admin-base');
    }
}
