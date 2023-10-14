<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.adminsidebar activePage="tables"></x-navbars.adminsidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        
       

        <div class="container-fluid py-4">
           <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">{{ $user->firstname }} {{ $user->lastname }}</h4>
                                <h5 class="text-white text-capitalize ps-3">Staff Number: {{ $user->staffnumber }}</h5>
                                <h6 class="text-white text-capitalize ps-3">Email: {{ $user->email }}</h6>
                                


                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered  align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Organization Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Members Working With</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($user->assignments->count() === 0)
                                         <p> No Assigned Assignment </p>
                                         @else
                                          @foreach($user->assignments as $assignment)
                                           <tr>
                                             <td>{{ $assignment->org_name }}</td>
                                             <td>
                                                @if ($assignment->users->count() > 1)
                                                    <select class="form-select">
                                                        @foreach ($assignment->users as $member)
                                                            @if ($member->id !== $user->id)
                                                                <option value="{{ $member->id }}">{{ $member->firstname }} {{ $member->lastname }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($assignment->status === 'Completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @elseif ($assignment->status === 'In Progress')
                                                    <span class="badge bg-warning text-dark">In Progress</span>
                                                @else
                                                    <span class="badge bg-info">Assigned</span>
                                                @endif
                                            </td>
                                            
                                           <td>
                                            @if ($assignment->chatRoom)
                                            <a href="{{ route('chat.show', ['roomId' => $assignment->chatRoom->id]) }}">
                                                <button type="button" class="btn btn-primary">Add Chat</button>
                                            </a>
                                            @else
                                            <!-- Handle the case when there is no chat room associated with the assignment -->
                                            <p>No chat room available</p>
                                            @endif

                                           </td> 
                                           
                                            

                                           
                                           </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </main>
   
</x-layout>