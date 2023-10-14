<!-- chat-room.blade.php -->
<div id="chat-room-container" data-room-id="{{ $chatRoom->id }}">
    <div class="chat-room" id="chat-room">
        @foreach ($chatRoom->messages as $message)
        <pre>
        @php

        @endphp
            <div class="message-container">
                {{-- {{ auth()->guard('admin')->check() && $message->user_type === 'admin' ? 'received' : 'sent' }}" --}}
                <div class="message {{ $message->user_type === 'admin' ? 'admin' : 'user' }}">
                    @if ($message->user_type === 'admin')
                        <p><strong>{{ $message->admin->firstname }}:</strong> {{ $message->content }}</p>
                    @else
                        @if ($message->user_type === 'user')
                            <p><strong>{{ $message->user->firstname }}:</strong> {{ $message->content }}</p>
                        @endif
                    @endif
                    
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- <style>
    .chat-room {
        display: flex;
        flex-direction: column;
    }

    .message-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .message {
        padding: 10px;
        border-radius: 10px;
        max-width: 70%;
        margin-left: 10px;
    }

    .sent {
        background-color: #DCF8C6; /* Light green for sent messages */
    }

    .received {
        background-color: #E0E0E0; /* Light grey for received messages */
    }
</style> --}}

<script>
    // Function to append a new message to the chat room
    function appendMessage(message, isUser) {
        const chatRoom = document.getElementById('chat-room'); // Make sure you have a container element with the ID 'chat-room'
        const messageElement = document.createElement('div');
        messageElement.textContent = message;
        messageElement.classList.add('message');
        messageElement.classList.add(isUser ? 'user' : 'admin');
        chatRoom.appendChild(messageElement);
    }

    // Function to fetch messages for the chat room
    function fetchMessages(roomId) {
        axios.get(`/api/chat/room/${roomId}/messages`)
            .then(response => {
                if (response.status === 200) {
                    const messages = response.data.messages;
                    // Loop through the messages and append them to the chat room
                    messages.forEach(message => {
                        appendMessage(message.message, message.user_type === 'user');
                    });
                }
            })
            .catch(error => {
                console.log('Error:', error);
            });
    }

    // Fetch messages for the chat room when the page loads
    const chatRoomId = document.getElementById('chat-room-container').getAttribute('data-room-id');
    fetchMessages(chatRoomId);

    // ... Other JavaScript code ...
</script>

