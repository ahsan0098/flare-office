<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicChat extends Model
{
    use HasFactory;
    protected $table = "public_chats";
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
