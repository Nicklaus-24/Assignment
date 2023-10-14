@props(['titlePage'])
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{-- <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div> --}}
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                            Out</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" onclick="toggleDarkMode()">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

                
                
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a class="nav-link text-body p-0" href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                        @endif
                    </a>
                    
                </li>
                
            </ul>
        </div>
    </div>
    <!-- Add this script to your page or global script file -->
    <script>
        // Function to toggle dark mode
        function toggleDarkMode() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true') {
                localStorage.setItem('darkMode', 'false');
            } else {
                localStorage.setItem('darkMode', 'true');
            }
            applyDarkMode(); // Apply dark mode immediately
        }
    
        // Function to apply dark mode styles
        function applyDarkMode() {
            const darkMode = localStorage.getItem('darkMode');
            const body = document.body;
            if (darkMode === 'true') {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }
        }
    
        // Apply the dark mode when the page loads
        document.addEventListener('DOMContentLoaded', applyDarkMode);
    </script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
const notificationBell = document.getElementById('dropdownMenuButton');
const notificationDropdown = document.getElementById('notificationDropdown');
let isDropdownOpen = false;

notificationBell.addEventListener('click', function () {
    if (!isDropdownOpen) {
        // Fetch notifications using Ajax and populate the notificationDropdown
        fetchNotifications();
    }
    isDropdownOpen = !isDropdownOpen;
    notificationDropdown.style.display = isDropdownOpen ? 'block' : 'none';
});

function fetchNotifications() {
    // Use Ajax to fetch notifications from the server
    fetch('/unread-notifications')
        .then(response => response.json())
        .then(data => {
            const unreadNotifications = data.filter(notification => !notification.read_at);
            const notificationsHtml = unreadNotifications.map(notification => generateNotificationHtml(notification)).join('');
            notificationDropdown.innerHTML = notificationsHtml;
            updateNotificationCount(unreadNotifications.length); // Update notification count
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });
}

            


    
        // Close notification event
        function closeNotification(notificationId) {
       fetch('{{ route('mark_notification_as_read', ['notification' => '__notification__']) }}'.replace('__notification__', notificationId), {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        notificationDropdown.innerHTML = data.html;
        updateNotificationCount(); // Update notification count
    })
    .catch(error => {
        console.error('Error closing notification:', error);
    });
}
              


function updateNotificationCount() {
    // Use Ajax to fetch the updated notification count from the server
    fetch('{{ route('get_notification_count') }}')
        .then(response => response.json())
        .then(data => {
            notificationCount.textContent = data.count;
        })
        .catch(error => {
            console.error('Error updating notification count:', error);
        });
}
    
        function markNotificationAsRead(notificationId) {
            fetch(`/mark-notification-as-read/${notificationId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                    Accept: "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove notification from dropdown
                    const notificationDiv = document.querySelector(`[data-notification-id="${notificationId}"]`);
                    if (notificationDiv) {
                        notificationDiv.parentNode.removeChild(notificationDiv);
                    }
    
                    // Update notification count in bell icon
                    const badge = document.querySelector(".badge.bg-danger");
                    if (badge) {
                        badge.textContent = parseInt(badge.textContent) - 1;
                    }
                }
            })
            .catch(error => {
                console.error("Error marking notification as read:", error);
            });
        }
    });
    </script> --}}
        
</nav>
