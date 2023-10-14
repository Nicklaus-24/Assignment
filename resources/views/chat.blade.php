<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>

    <x-navbars.adminsidebar activePage="tables"></x-navbars.adminsidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Chats</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Chats</div>
                                            <div class="panel-body">
                                                <ul class="chat-messages">
                                                    @foreach($messages as $message)
                                                    <li class="chat-message">
                                                        @if(auth()->guard('admin')->check() && $message->user->is_admin)
                                                            <strong>{{ $message->user->firstname }} (Admin):</strong> {{ $message->content }}
                                                        @else
                                                            <strong>{{ $message->user->firstname }}:</strong> {{ $message->content }}
                                                        @endif
                                                    </li>
                                                    @endforeach
                                            </ul>
                                            
                                            
                                            </div>
                                            <div class="panel-footer">
                                                @auth('admin')
                                                <form action="{{ route('admin.chat.sendMessage') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ auth()->guard('admin')->user()->id }}">
                                                    <input type="hidden" name="user_type" value="admin">
                                                    <input type="text" name="content" placeholder="Type your message">
                                                    <button type="submit">Send</button>
                                                </form>
                                                @else
                                                <form action="{{ route('chat.sendMessage') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="user_type" value="user">
                                                    <input type="text" name="content" placeholder="Type your message">
                                                    <button type="submit">Send</button>
                                                </form>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
