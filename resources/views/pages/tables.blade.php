<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
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
        <style>
            .popup {
                position: fixed;
                top: 5%;
                left: 50%;
                width:50%;
                transform: translate(-50%, -50%);
                background-color: rgb(5, 105, 167);
                border: 1px solid lightgray;
                border-radius: 5px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                z-index: 9999;
                animation: fadeIn 1s;
              }
            
              .popup-content {
                margin-bottom: 10px;
                color:whitesmoke;
              }
            
              @keyframes fadeIn {
                0% { opacity: 0; }
                100% { opacity: 1; }
              }
            
              @keyframes fadeOut {
                0% { opacity: 1; }
                100% { opacity: 0; }
              }
            </style>
            @if(session('success'))
            <div id="popup" class="popup">
            <div class="popup-content">
            {{ session('success') }}
            </div>
            </div>
            @endif
            <script>
                // Close the pop-up after a few seconds
                setTimeout(function() {
                  var popup = document.getElementById('popup');
                  if (popup) {
                    popup.style.animation = 'fadeOut 1s';
                    setTimeout(function() {
                      popup.remove();
                    }, 1000);
                  }
                }, 3000);
              </script>
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
                                <table id="example" class="table table-bordered  align-items-center justify-content-center mb-0">
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
                                        @foreach($assignments as $assignment)
                                        @if($assignment->users->contains(auth()->user()))
                                         <tr>
                                          <td>{{$assignment->id}}</td>
                                          <td>{{$assignment->org_name}}</td>
                                          <td>{{$assignment->request_type}}</td>
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
                                    {{ $assignments->links('pagination::bootstrap-4') }}
                                </div>
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

