<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{

    protected $fillable =[
        'assignment_id',
    ];

    public function assignment()
    {
        return $this->hasOne(Assignment::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

}

