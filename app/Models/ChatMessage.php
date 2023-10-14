<?php

// app/Models/ChatMessage.php

namespace App\Models;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{


    protected $table = 'chat_messages';
    protected $fillable =[
        'chat_room_id',
        'user_id',
        'message',
        'user_type',
    ];
    // ...

    /**
     * Get the chat room that owns the message.
     */
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    /**
     * Get the user who sent the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'user_id'); //  foreign key for the admin ID is 'user_id'
    }

    // ...
}

