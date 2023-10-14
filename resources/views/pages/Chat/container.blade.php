<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.adminsidebar activePage="tables" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Chat" />
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Container</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div id="message-container">
                                @include('pages.Chat.messageContainer')
                            </div>
                            
                            <div id="input-message-container">
                                @include('pages.Chat.inputMessage', ['currentRoom' => $currentRoom ?? null])
                            </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentAssignment = @json($currentAssignment);
        const chatRooms = @json($chatRooms);

        // Function to append a new message to the message container
        function appendMessage(message) {
            // Create a new message element
            const messageElement = document.createElement('div');
            messageElement.textContent = message;

            // Append the message element to the message container
            const messageContainer = document.getElementById('message-container');
            messageContainer.appendChild(messageElement);
        }

        // Function to handle sending a message
        function sendMessage() {
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();

            if (message === '') {
                return;
            }

            axios
                .post(`/chat/room/${currentAssignment.chat_room_id}/message`, {
                    message: message,
                })
                .then(function(response) {
                    if (response.status === 201) {
                        messageInput.value = '';
                        appendMessage(message);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        // Add click event listener to the send button
        const sendButton = document.getElementById('send-button');
        sendButton.addEventListener('click', sendMessage);

        // Add keyup event listener to the message input field
        const messageInput = document.getElementById('message-input');
        messageInput.addEventListener('keyup', function(event) {
            if (event.keyCode === 13) {
                sendMessage();
            }
        });

        // Function to handle selecting a chat room
        function selectChatRoom(chatRoom) {
            // Update the current assignment's chat room ID
            currentAssignment.chat_room_id = chatRoom.id;

            // Update the UI to reflect the selected chat room

            // Fetch messages for the selected chat room

            // You can update the message container and input container accordingly

            console.log('Selected Chat Room:', chatRoom);
        }

        // Render the chat rooms
        chatRooms.forEach(function(chatRoom) {
            const chatRoomElement = document.createElement('div');
            chatRoomElement.textContent = chatRoom.name;
            chatRoomElement.addEventListener('click', function() {
                selectChatRoom(chatRoom);
            });

            const chatRoomContainer = document.getElementById('chat-room-container');
            chatRoomContainer.appendChild(chatRoomElement);
        });
    });
</script>
@endpush
