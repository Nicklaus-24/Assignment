<?php

namespace App\Events;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadCast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $chatRoom;
    public $isUser;

    /**
     * Create a new event instance.
     */
    public function __construct(ChatMessage $newMessage, ChatRoom $chatRoom)
    {
        $this->message = $newMessage->message; // Use $newMessage instead of $message
        $this->chatRoom = $chatRoom->chatRoom;
        $this->isUser = $newMessage->user_type === 'user'; // Adjust this based on your user_type values
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|Channel[]
     */
    public function broadcastOn()
    {
        // Broadcast the event to the 'assignmenthandling' channel
        return new Channel('assignmenthandling');
    }

    public function broadcastAs()
    {
        return 'NewChatMessage';
    }
}
