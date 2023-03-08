<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\PrivateChat;

class AdminChatroom extends Component
{
    public $test = "ahsan";
    public $me;
    public $other = null;
    public $agent;
    public $users;
    public $chat = [];
    public $chat_code;
    public $message;
    public function mount()
    {
        $this->me = session()->get('u_id');
        $this->users = User::where('id', '!=', $this->me)->with('sender')->with('receiver')->get();
        $this->test=PrivateChat::where()
        // $this->users = json_decode($this->users, true);
        // $this->me = User::where('e', session('user_email'))->first();
        // $this->me = $this->me->id;
        // $this->users = PrivateChat::where(function ($query) {
        //     $query->where('status', '=', 1);
        // })->where(
        //     function ($query) {
        //         $query->orWhere('sender_id', $this->me)
        //             ->orWhere('receiver_id', $this->me);
        //     }
        // )->with('sender')->orderBy("created_at", "ASC")->get();
        // $this->chat = json_decode($this->users, true);
        // foreach ($this->chat as $ct) {
        //     $this->chat_number = $ct['chat_number'];
        //     break;
        // }
    }
    public function getChat($other)
    {
        // $this->test = $other;
        $this->other = $other;
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
        foreach ($this->chat as $ct) {
            $this->chat_code = $ct->chat_code;
            // $ct->created_at = $ct->created_at->format('Y-m-d');
            break;
        }
        $this->chat = json_decode($this->chat, true);
    }
    // public function replyUser()
    // {

    //     $this->users = PrivateChat::where('status', '=', 1)->where(
    //         function ($query) {
    //             $query->orWhere('sender_id', $this->me)
    //                 ->orWhere('chat_number', $this->chat_number);
    //         }
    //     )->where('message', '!=', 'Hey agent help me to handle this customer')->with('sender')->orderBy("created_at", "ASC")->get();
    //     $this->chat = json_decode($this->users, true);
    //     foreach ($this->chat as $ct) {
    //         $this->chat_number = $ct['chat_number'];
    //         $this->agent = $ct['receiver_id'];
    //         break;
    //     }
    // }
    public function sendMsg()
    {
        // $this->test = $this->other . "working";

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
                $message = new PrivateChat;
                $message->sender_id = $this->me;
                $message->receiver_id = $this->other;
                $message->message = $this->message;
                $message->chat_code = $chat_num;
                $message->save();
            } else {
                goto again;
            }
        }
        $this->message = "";
    }
    public function refreshing()
    {
        if ($this->chat_code != null) {
            $this->chat = PrivateChat::where('chat_code', $this->chat_code)->with('sender')->get();
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-chatroom')->layout('layouts.admin-base');
    }
}
