<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
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
                                <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered  align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignmentsInProgress as $assignment)
                                        @if($assignment->users->contains(auth()->user()))
                                         <tr>
                                          <td>{{$assignment->id}}</td>
                                          <td>{{$assignment->org_name}}</td>
                                          <td>{{$assignment->request_type}}</td>
                                          <td>
                                            @if ($assignment->status === 'In Progress')
                                            <span class="badge bg-warning text-dark">In Progress</span>
                                           @endif
                                          </td>
                                           <td>
                                              <a href ="{{route('user_view_details', $assignment->id)}}">
                                               <button type="button" class="btn btn-dark">View Details</button>
                                              </a>
                                          </td>
                                          <td>
                                            @if ($assignment->chatRoom)
                                            <a href="{{ route('user.chatRoom', ['roomId' => $assignment->chatRoom->id]) }}">
                                                <button type="button" class="btn btn-primary">Add Chat</button>
                                            </a>
                                            @else
                                            <!-- Handle the case when there is no chat room associated with the assignment -->
                                            <p>No chat room available</p>
                                            @endif

                                           </td> 
                                         </tr>
                                        @endif

                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $assignmentsInProgress->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </main>
</x-layout>