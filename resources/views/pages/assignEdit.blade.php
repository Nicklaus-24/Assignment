<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.adminsidebar activePage="tables"></x-navbars.adminsidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.authadmin titlePage="Tables"></x-navbars.navs.authadmin>
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
                                <h6 class="text-white text-capitalize ps-3">Edit Assignment Details</h6>

                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <style> 
                                input[type=text],
                                input.date-input,
                                input[type=file],
                                textarea {
                                 
                                  width: 100%;
                                  padding: 12px 20px;
                                  margin: 8px 0;
                                  box-sizing: border-box;
                                  /* border: 2px solid purple; */
                                  border-radius: 4px;
                                  background-color:rgb(241, 241, 241);
                                  
                                }
                                .smaller-textarea {
                                  width: 100%;
                                  padding: 12px 20px;
                                  margin: 8px 0;
                                  box-sizing: border-box;
                                  border-radius: 4px;
                                  background-color: rgb(241, 241, 241);
                                 }
                                  
                                 .smaller-textarea:hover {
                                    background-color:rgba(255, 166, 0, 0.208)
                                 }

                                .smaller-input {
                                width: 150px; /* Adjust the width as needed */
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
                            <form  method="POST" action="{{route('assignUpdate',['id' => $assignment->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                               
                                
                                <div class="mb-3 ">
                                    <label for="org_name" class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" id="org_name" name="org_name" value="{{ $assignment->org_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="request_type" class="form-label">Request Type</label>
                                    <input type="text" class="form-control" id="request_type" name="request_type" value="{{ $assignment->request_type }}">
                                    <p style="color: red;">It can only be BPR, Domain,Website, Mail Setup or Others</p>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control smaller-textarea" id="description" name="description" rows="3">{{ old('description', $assignment->description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="attachment" class="form-label">Attachment</label>
                                    @if ($assignment->attachment)
                                        <p>Current Attachment: <a href="{{ asset('storage/' . $assignment->attachment) }}" class="btn btn-primary" target="_blank">{{ $assignment->attachment }}</a></p>
                                        <label for="remove_attachment">
                                            <input type="checkbox" id="remove_attachment" name="remove_attachment" value="1"> Remove Attachment
                                            
                                        </label>
                                    @else
                                        <p>No attachment uploaded.</p>
                                    @endif
                                </div>
                                {{-- adding a different attachment --}}
                                <div class="mb-3">
                                    <label for="attachment" class="form-label">New Attachment</label>
                                    <input type="file" class="form-control " id="new_attachment" name="new_attachment">
                                </div>
                                
                            
                                
                                <div class="mb-3">
                                    <label for="date_request_received" class="form-label">Date Request Received</label>
                                    <input type="date" class="form-control smaller-input" id="date_request_received" name="date_request_received" value="{{ old('date_request_received', $assignment->date_request_received) }}">
                                </div>
                                
       
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control smaller-textarea" id="status" name="status">
                                        <option value="assigned" @if ($assignment->status === 'assigned') selected @endif>Assigned</option>
                                        <option value="unassigned" @if ($assignment->status === 'unassigned') selected @endif>Unassigned</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="members_assigned" class="form-label">Members Assigned</label>
                                    <select class="form-control" id="members_assigned" name="members_assigned[]" multiple>
                                        <!-- Render the list of users as options -->
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if (in_array($user->id, $assignment->users->pluck('id')->toArray())) selected @endif>
                                            {{ $user->firstname }} {{ $user->lastname }} {{ $user->staffnumber }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                
                                
                                
                                <button type="submit"  class="btn bg-gradient-dark">Save Changes</button>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</x-layout>
                            