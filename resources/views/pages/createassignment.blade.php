<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.adminsidebar activePage="tables"></x-navbars.adminsidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.authadmin titlePage="Tables"></x-navbars.navs.authadmin>
        <!-- End Navbar -->

        <!--Flatpickr for the date -->
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
                                input[type=text]
                                {
                                    background-color:  rgb(253, 244, 244);
                                }

                                input[type=file]
                                {
                                    background-color:  rgb(253, 244, 244);
                                }

                                textarea[id=description]
                                {
                                    background-color:  rgb(253, 244, 244);
                                }
                                select[id=status]
                                {
                                    background-color:  rgb(253, 244, 244);
                                }


                               
                                </style>

                            <!-- Assignment form -->
                            <form method="POST" action="{{ route('store_assignment') }}" class="w-full max-w-2xl"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="w-full p-4">
                                    <label for="org_name" class="form-label">Organization Name:</label>
                                    <input type="text" id="org_name" name="org_name"
                                        class="form-control border border-black px-2 py-1 rounded" required>
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="request_type" class="form-label">Request Type:</label>
                                    <select id="request_type" name="request_type" class="form-select border border-black px-2 py-1 rounded" required>
                                        <option selected hidden ="Select Request Type">Select Request Type</option>
                                        <option value="BPR">BPR</option>
                                        <option value="domain">Domain</option>
                                        <option value="Website">Website</option>
                                        <option value="Mail Setup">Mail Setup</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="attachment" class="form-label">Attach File:</label>
                                    <input type="file" id="attachment" name="attachment"
                                        accept="image/*,.pdf,.doc,.docx,.xls,.xlsx"
                                        class="form-control  border border-black px-2 py-1 rounded"
                                        onchange="handleFileInput(this)" required>
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea id="description" name="description"
                                        class="form-control border border-black px-2 py-1 rounded" required></textarea>
                                </div>

                                <div class="w-full p-4">
                                    <label for="date_request_received" class="form-label">Date Request Received:</label>
                                    <input type="date" id="date_request_received" name="date_request_received"
                                        class="border border-black px-2 py-1 rounded">
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select id="status" name="status" class="form-select border border-black px-2 py-1 rounded" required>
                                        <option value="Assigned">Assigned</option>
                                        <option value="Unassigned">Unassigned</option>
                                    </select>
                                </div>
                                
                                <div class="w-4/4 p-4" id="membersAssignedField" style="display: none;">
                                    <label class="form-label">Members Assigned:</label>
                                    @foreach($users as $user)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="members_assigned[]" value="{{ $user->id }}" id="user{{ $user->id }}">
                                            <label class="form-check-label" for="user{{ $user->id }}">
                                                {{ $user->firstname }} {{ $user->lastname }} {{ $user->staffnumber }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                
                                
                                <script>
                                    document.getElementById('status').addEventListener('change', function() {
                                        var membersAssignedField = document.getElementById('membersAssignedField');
                                        membersAssignedField.style.display = this.value === 'Assigned' ? 'block' : 'none';
                                    });
                                </script>
                                <button type="submit" class="btn bg-gradient-dark">Submit</button>   
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
                                      
                
   <!--  Flatpickr script -->
   <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
   <script>
       flatpickr("#date_request_received", {
           dateFormat: "Y-m-d",
           
       });
   
       function handleFileInput(input) {
           // Handle file input changes here
       }
   </script>             
                
