<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;
    public function subDepartment()
    {
        return $this->hasMany(subdepartment::class, 'dep_id');
    }
    // public function user()
    // {
    //     return $this->hasMany(User::class, 'id');
    // }
}
