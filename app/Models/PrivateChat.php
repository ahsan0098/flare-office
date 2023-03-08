<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateChat extends Model
{
    use HasFactory;
    // public $timestamps = false;
    // protected $dateFormat = 'U';
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
