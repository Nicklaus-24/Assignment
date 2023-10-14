<?php


namespace App\Listeners;

use App\Events\NewChatMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewChatMessage $event)
    {
        // Get the chat room data and the new message from the event
        $chatRoom = $event->chatRoom;
        $message = $event->message; // Use $event->message instead of $event->newMessage

        // Broadcast the new message to the specified channel (in this case, the chat room channel)
        broadcast(new NewChatMessage($message, $chatRoom))->toOthers();
    }
}
