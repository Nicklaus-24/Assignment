<!-- userChatRoom.blade.php -->
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                                <div class="card-body px-0 pb-2">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                            <h6 class="text-white text-capitalize ps-3">Chat Room</h6>
                                            <h6 class="ps-3">Organization: {{ $chatRoom->assignment->org_name }}</h6>
                                            <h6 class="ps-3">Assignment Request Type: {{ $chatRoom->assignment->request_type }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @include('pages.chat.chat-room', ['chatRoom' => $chatRoom])
                                 <!-- Form to send messages -->
                               <form id="message-form" method="POST" action="{{ route('chat.sendMessage', ['roomId' => $roomId]) }}">
                                @csrf
                                
                                 <input type="text" name="message"  id="message-input" placeholder="Say something...." required>
                                 <button type="submit">Send</button>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <style>
        .chat-room {
            display: flex;
            flex-direction: column;
        }
    
        .message-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-bottom: 10px;
        }
    
        .message {
            padding: 10px;
            border-radius: 10px;
            max-width: 70%;
        }
    
        .sent {
            background-color: #DCF8C6; /* Light green for sent messages */
        }
    
        .received {
            background-color: #E0E0E0; /* Light grey for received messages */
            align-items: flex-start;
        }
    
        .user-name {
            font-size: 12px;
            color: #888;
        }
    </style>
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
</x-layout>
