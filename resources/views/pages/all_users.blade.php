<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.adminsidebar activePage="tables"></x-navbars.adminsidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.authadmin titlePage="Tables"></x-navbars.navs.authadmin>
        <!-- End Navbar -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/searchpanes/1.3.0/js/dataTables.searchPanes.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.3.0/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
        
       

        <div class="container-fluid py-4">
           <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Members</h6>
                                <a href="{{route('addMember')}}">
                                <button type="button" class="btn btn-dark">Add Member</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="example" class="table table-bordered  align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Staff Number</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">First Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Number of Assignments</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->staffnumber}}</td>
                                            <td>{{$user->firstname}}</td>
                                            <td>{{$user->lastname}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->assignments->count()}}</td>
                                            
                                            
                                        
                                            <td>
                                                <a href ="{{route('user_show',$user->id)}}">
                                                 <button type="button" class="btn btn-dark">View Details</button>
                                                </a>
                                            </td>

                                            <td>
                                            
                                                 <button type="button" class="btn btn-danger">Delete</button>
                                                
                                            </td>

                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                <a href="{{route('adminDashboard')}}">
                                    <button type="submit" class="btn btn-dark"> Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
    $('#example').DataTable({
        buttons: [
            'searchPanes'
        ],
        dom: 'Bfrtip'
    });
});
</script>
   
</x-layout>