<?php

namespace App\Http\Livewire\Employe;

use App\Models\User;
use Livewire\Component;
use App\Models\PublicChat;
use App\Models\PrivateChat;

class EmployeChatRoom extends Component
{
    public $test = "ahsan";
    public $me;
    public $other = null;
    public $agent = "Ssg";
    public $users;
    public $chat = [];
    public $chat_code;
    public $message;
    public function mount()
    {
        $this->me = session()->get('u_id');
        $this->users = User::where('id', '!=', $this->me)->with('sender')->with('receiver')->get();
        $this->test = PrivateChat::where(
            function ($query) {
                $query->where('sender_id', $this->me)
                    ->orWhere('receiver_id', $this->me);
            }
        )->orderBy('id', 'DESC')->first();
        if ($this->test) {
            $this->chat_code = $this->test->chat_code;
            if ($this->test->receiver_id == $this->me) {
                $this->other = $this->test->sender_id;
            } else {
                $this->other = $this->test->receiver_id;
            }
            $this->test = PrivateChat::where('chat_code', $this->test->chat_code)->with('sender')->get();
            $this->test = json_decode($this->test, true);
        }
    }
    public function getChat($other)
    {
        $this->other = $other;
        $this->chat_code = null;
        $this->chat = PrivateChat::where(
            function ($query) use ($other) {
                $query->where('sender_id', $this->me)
                    ->Where('receiver_id', $other);
            }
        )->orWhere(
            function ($query) use ($other) {
                $query->where('sender_id', $other)
                    ->where('receiver_id', $this->me);
            }
        )->with('sender')->get();
        if ($this->chat) {
            foreach ($this->chat as $ct) {
                $this->chat_code = $ct->chat_code;
                break;
            }
        } else {
            $this->chat_code = null;
        }
        $this->chat = json_decode($this->chat, true);
    }

    public function sendMsg()
    {
        if ($this->message != '') {
            if ($this->chat != []) {
                $message = new PrivateChat;
                $message->sender_id = $this->me;
                $message->receiver_id = $this->other;
                $message->message = $this->message;
                $message->chat_code = $this->chat_code;
                $message->save();
            } else {
                again:
                $chat_num = rand(100000, 999999);
                $cht = PrivateChat::where('chat_code', $chat_num)->first();
                if (!$cht) {
                    if ($this->other != null) {
                        $message = new PrivateChat;
                        $message->sender_id = $this->me;
                        $message->receiver_id = $this->other;
                        $message->message = $this->message;
                        $message->chat_code = $chat_num;
                        $message->save();
                        $this->chat_code = $chat_num;
                    }
                } else {
                    goto again;
                }
            }
            $this->message = "";
        }
    }
    public function refreshing()
    {
        if ($this->chat_code != null) {
            $this->chat = PrivateChat::where('chat_code', $this->chat_code)->with('sender')->get();
        } else {
            $this->chat == null;
            $this->chat_code == null;
        }
    }
    public function render()
    {
        return view('livewire.employe.employe-chat-room')->layout('layouts.user-base');
    }
}
