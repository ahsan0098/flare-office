<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    public function department()
    {
        return $this->belongsTo(department::class, 'department_id');
    }
    public function position()
    {
        return $this->belongsTo(subdepartment::class, 'sub_department_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'employe_id')->where('date', date('y-m-d'));
    }
    public function dated()
    {
        return $this->hasMany(Attendance::class, 'employe_id')->where('date', date('y-m-d'));
    }
    public function employe()
    {
        return $this->hasMany(Attendance::class, 'employe_id');
    }
    public function month()
    {
        return $this->hasMany(Attendance::class, 'employe_id')->whereMonth('date', '=', '6');
    }
    public function sender()
    {
        return $this->hasMany(PrivateChat::class, 'sender_id');
    }
    public function receiver()
    {
        return $this->hasMany(PrivateChat::class, 'receiver_id');
    }
    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
