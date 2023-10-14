<x-layout bodyClass="g-sidenav-show  bg-gray-200">
     
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-navbars.adminsidebar activePage='adminDashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.authadmin titlePage=" Admin Dashboard"></x-navbars.navs.authadmin>
        <!-- End Navbar -->
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        {{-- calendar links --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <a href="{{ route('admin_assignments') }}">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">assignment</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Projects</p>
                                <h4 class="mb-0">{{ $totalProjects}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than
                                lask week</p>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                     <a href="{{route('assignedAssignments')}}">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">assignment_turned_in</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Assigned Projects</p>
                                <h4 class="mb-0">{{$assignedAssignments}} </h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than
                                lask month</p>
                        </div>
                     </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                     <a href="{{route('unassignedAssignments')}}">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">assignment_late</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Unassigned Projects</p>
                                <h4 class="mb-0">{{$unassignedAssignments}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                                yesterday</p>
                        </div>
                     </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                      <a href="{{route('allMembers')}}">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">assignment_ind</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Staff </p>
                                <h4 class="mb-0">{{$membersAssigned}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                                yesterday</p>
                        </div>
                      </a>
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Rquest Types</h6>
                            <p class="text-sm ">Represents the types of requests received</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">Records Periodically</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Assessment</h6>
                            <p class="text-sm "> (<span class="font-weight-bolder">Number of projects being handled by each member</span>)  </p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm"> Records Periodically </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Completed Tasks</h6>
                            <p class="text-sm ">Tasks Completed </p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">just updated</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div id="eventModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Event</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <label for="eventTitle">Event Title:</label>
                                <input type="text" id="eventTitle" class="form-control" required><br>
                                <label for="eventVenue">Venue:</label>
                                <input type="text" id="eventVenue" class="form-control"><br>
                                <label>Participants:</label><br>
                                @foreach ($users as $user)
                                 <div class="form-check">
                                  <input type="checkbox" class="form-check-input" name="user_id[]" value="{{ $user->id }}" id="participant_{{ $user->id }}">
                                  <label class="form-check-label" for="participant_{{ $user->id }}">{{$user->staffnumber}}->{{ $user->firstname }} {{ $user->lastname }}</label>
                                 </div>
                                @endforeach<br>
                                <label for="start">Start Date and Time:</label>
                                <input type="datetime-local" id="start" name="start" required><br>
                                <label for="end">End Date and Time:</label>
                                <input type="datetime-local" id="end" name="end" required><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="saveEventBtn" class="btn btn-primary" >Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                       
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Today's Events</h6>
                            
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group list-group-flush">
                                @forelse ($events as $event)
                                <li class="list-group-item" style="font-weight: bold; color: red;">
                                    <span class="event-time ">{{ $event->start->format('H:i') }} - {{ $event->end->format('H:i') }}</span>
                                    <span class="event-title">{{ $event->title }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <span class="no-events">No events for the day</span>
                                </li>
                            @endforelse
                            </ul>
                               
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    <script>

$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/full-calendar',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            // Show a modal dialog to input event details
             $('#eventModal').modal('show');

              // Fetch users from the backend and populate the "Participants" dropdown
    $.ajax({
        url: '/all_users', // Replace with your backend endpoint to fetch users
        type: 'GET',
        success: function (data) {
            var user_idDropdown = $('#user_id');
            user_idDropdown.empty();

            // Add an option for selecting no user
            user_idDropdown.append($('<option>', {
                value: '', // No user selected
                text: 'Select User'
            }));

            // Populate the dropdown with fetched users
            $.each(data.users, function (index, user) {
                user_idDropdown.append($('<option>', {
                    value: user.id,
                    text: user.firstname + ' ' + user.lastname
                }));
            });
        }
    });


                  

             $('#saveEventBtn').on('click', function () {
               var title = $('#eventTitle').val();
               var venue = $('#eventVenue').val();
               var user_id = $('input[name="user_id[]"]:checked').map(function () {
              return $(this).val();
              }).get();
               var start = $('#start').val();
               var end = $('#end').val();


             if(title)
            {
                var startFormatted = moment(start).format('YYYY-MM-DD HH:mm:ss');
                 var endFormatted = moment(end).format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                    
                    url:"/full-calendar/action",
                    type:"POST",
                    data:{
                        title: title,
                        venue:venue,
                        user_id:user_id,
                        start: startFormatted,
                        end: endFormatted,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                });

                $('#eventModal').modal('hide');
            }
        });
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calendar/action",
                type:"POST",
                data:{
                    title: title,
                    venue:venue,
                    user_id:user_id,
                    start: startFormatted,
                    end: endFormatted,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    venue:venue,
                    user_id:user_id,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/full-calendar/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }
    });

});
  
</script>
<script>
    // Get the data from the PHP variable passed from the controller
    const chartData = @json($data);

    // Extract labels (requesttype) and count values from the data
    const labels = chartData.map(item => item.label);
    const counts = chartData.map(item => item.count);

    console.log("Labels:", labels); // Check if labels exist in the console
    console.log("Counts:", counts); // Check if counts exist in the console

    // Create the bar chart using Chart.js
    const ctx = document.getElementById('chart-bars').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels, // Use the extracted labels
            datasets: [{
                label: 'Request Type Count',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        autoSkip: false, // Prevent the X-axis labels from being skipped
                    },
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false // Hide the legend
                },
                tooltip: {
                    callbacks: {
                        label: (context) => `${context.parsed.y} Requests`, // Show the count in the tooltip
                    }
                }
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Replace this part with your actual data
        var userNames = @json($userNames);
        var taskCounts = @json($taskCounts);

        var ctx = document.getElementById('chart-line').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: userNames,
                datasets: [{
                    label: 'Number of Tasks Working On',
                    data: taskCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 10,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        display: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },

                
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Replace this part with your actual data
        var requestTypeLabels = @json($requestTypeLabels);
        var completedTaskCounts = @json($completedTaskCounts);

        var ctx = document.getElementById('chart-line-tasks').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: requestTypeLabels,
                datasets: [{
                    label: 'Completed Tasks',
                    data: completedTaskCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        display: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>        


 
    @endpush
</x-layout>
