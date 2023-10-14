<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- Include Flatpickr styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

        <!-- Main content -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Project</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <style> 
                                input[type=text],
                                input.date-input,
                                textarea {
                                 
                                  width: 100%;
                                  padding: 12px 20px;
                                  margin: 8px 0;
                                  box-sizing: border-box;
                                  /* border: 2px solid purple; */
                                  border-radius: 4px;
                                  background-color:rgb(241, 241, 241);
                                  
                                }

                                input[type='text']:hover{
                                    background-color:rgba(255, 166, 0, 0.208)
                                }

                                body {
                                 
                                 margin-left: 2px;
                                 }
                                 form {
                                  margin-left:12px;
                                  margin-inline-end: 12px;
                                }
                                </style>
                            <!-- Assignment form -->
                            <div class="center">
                                <form action="{{ route('updateStatus', $assignment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                        
                                
                                <div class="mb-3 ">
                                    <label for="org_name" class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" id="org_name" data-readonly readonly value="{{ $assignment->org_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="request_type" class="form-label">Request Type</label>
                                    <input type="text" class="form-control" id="request_type" data-readonly readonly value="{{ $assignment->request_type }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3" data-readonly readonly>{{ $assignment->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="attachment" class="form-label">Attachment</label>
                                    <div>
                                        @if($assignment->attachment)
                                            <a href="{{ asset('storage/' . $assignment->attachment) }}" class="btn btn-primary" target="_blank">View Attachment</a>
                                        @else
                                            <p>No attachment</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="date_request_received" class="form-label">Date Request Received</label>
                                    <input type="text" class="form-control" id="date_request_received" data-readonly readonly value="{{ $assignment->date_request_received }}">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    @if ($assignment->status === 'Assigned')
                                        <div class="mb-3">
                                            <select class="form-control" id="status" name="status">
                                                <option value="In Progress" @if ($assignment->status === 'In Progress') selected @endif>In Progress</option>
                                                <option value="Completed" @if ($assignment->status === 'Completed') selected @endif>Completed</option>
                                            </select>
                                        </div>
                                    @elseif($assignment->status === 'In Progress')
                                        <div class="mb-3">
                                            <select class="form-control" id="status" name="status">
                                                <option value="In Progress" @if ($assignment->status === 'In Progress') selected @endif>In Progress</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    @elseif($assignment->status === 'Completed')
                                        <div class="mb-3">
                                            <select class="form-control" id="status" name="status">
                                                <option value="In Progress">In Progress</option>
                                                <option value="Completed" @if ($assignment->status === 'Completed') selected @endif>Completed</option>
                                            </select>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                                
                                
                                <div class="mb-3">
                                    <label for="members_assigned" class="form-label">Members Assigned</label>
                                    @if ($assignment->users->count() > 0)
                                        <ul>
                                            @foreach($assignment->users as $user)
                                                <li>{{ $user->firstname }}  {{ $user->lastname }} {{ $user->staffnumber }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No members assigned.</p>
                                    @endif
                                </div>
                                
                                
                                <div class="flex">
                                <a href="{{ route('tables') }}">
                                    <button type="button" class="btn bg-gradient-dark">Back</button>
                                 </a>

                                 
                                </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</x-layout>
                            