<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChatMessage;

class Admin extends Model implements Authenticatable

{
    use HasFactory;

    protected $table='admins';

    protected $fillable=[
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar',

    ];

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function role()
    {
      return $this->belongsTo(Role::class);
     }


     public function messages()
    {
      return $this->hasMany(ChatMessage::class);
    }

    public function assignments()
   {
       return $this->belongsToMany(Assignment::class, 'assignment_user');
   }
}
