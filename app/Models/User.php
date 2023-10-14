<?php

namespace App\Models;
use App\Models\Event;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'staffnumber',
        'password',
        'role',
        'avatar',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = bcrypt($password);
    // }


    public function role()
  {
    return $this->belongsTo(Role::class);
   }

   public function isAdmin()
   {
       return $this->role->name === 'admin';
   }

   public function assignments()
   {
       return $this->belongsToMany(Assignment::class, 'assignment_user');
   }



   public function events()
    {
        return $this->hasMany(Event::class);
    }
//    public function sender()
// {
//     return $this->belongsTo(User::class, 'from_user');
// }

// public function receiver()
// {
//     return $this->belongsTo(User::class, 'to_user');
// }



}





