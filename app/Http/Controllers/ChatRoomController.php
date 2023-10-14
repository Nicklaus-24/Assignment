<?php

namespace App\Http\Controllers;
use App\Events\NewChatMessage;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatRoomController extends Controller
{
    public function showChatRoom($roomId)
{  
    $chatRoom = ChatRoom::with(['messages.user', 'assignment'])->findOrFail($roomId);

    // Check if the user is authorized to access the assignment
    if (Gate::denies('access-assignment', $chatRoom->assignment)) {
        abort(403); // Return a 403 Forbidden response if not authorized
    }

    // If authorized, continue with showing the chat room
    $assignmentId = $chatRoom->assignment_id;
    return view('pages.chat.chatroom_show', compact('chatRoom', 'roomId', 'assignmentId'));
}

public function userChatRoom($roomId)
{
    $chatRoom = ChatRoom::with(['messages.user', 'assignment'])->findOrFail($roomId);

    // Check if the user is authorized to access the assignment
    if (Gate::denies('access-assignment', $chatRoom->assignment)) {
        abort(403); // Return a 403 Forbidden response if not authorized
    }

    // If authorized, continue with showing the chat room
    $assignmentId = $chatRoom->assignment_id;
    return view('pages.chat.userchatroom_show', compact('chatRoom', 'roomId', 'assignmentId'));
}

public function sendMessage(Request $request, $roomId)
{
    $user = Auth::user();
    $isAdmin = false;
    if($user instanceof App\Models\Admin){
        $isAdmin = true;
    }

    // if (!$user && !$isAdmin) {
    //     return response()->json(['error' => 'User not authenticated'], 401);
    // }

    // $userId = 
    // $userType = $isAdmin ? 'admin' : 'user';

    // Save the message with the correct user ID and user type
    $newMessage = new ChatMessage;
    $newMessage->chat_room_id = $roomId;
    $newMessage->user_id = $isAdmin ? Auth::guard('admin')->id() : $user->id;
    $newMessage->user_type = $isAdmin ? 'admin' : 'user'; // Explicitly set the user_type attribute
    $newMessage->message = $request->message;
    $newMessage->save();

    $chatRoom = ChatRoom::with(['messages.user', 'assignment'])->findOrFail($roomId);
    $assignmentId = $chatRoom->assignment_id;

    if ($isAdmin) {
        return redirect()->route('chat.show', compact('roomId'));
    } else {
        return redirect()->route('user.chatRoom', compact('roomId'));
    }


    //return view('pages.chat.userchatroom_show', compact('chatRoom', 'roomId', 'assignmentId'));

    // Return the saved message as a JSON response
    //return response()->json(['message' => 'Message sent successfully', 'newMessage' => $newMessage] );
}

public function getMessages($roomId)
{
    // Get all messages for the specified chat room
    $messages = ChatMessage::where('chat_room_id', $roomId)->get();

    // Return the messages as a JSON response
    return response()->json(['messages' => $messages], 200);
}
}