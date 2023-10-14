<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.adminsidebar activePage="admin-profile"></x-navbars.sidebar>
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <!-- Navbar -->
            <x-navbars.navs.authadmin titlePage='Administrator Profile'></x-navbars.navs.authadmin>
            <!-- End Navbar -->
            <div class="container-fluid px-2 px-md-4">
                <div class="page-header min-height-300 border-radius-xl mt-4"
                    style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                    <span class="mask  bg-gradient-primary  opacity-6"></span>
                </div>
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <div class="row gx-4 mb-2">
                        <div class="col-auto">
                            <form method="POST" action="{{ route('admin-profile') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="avatar avatar-xl position-relative" onclick="selectImage()">
                                <img src="{{ asset('assets') }}/img/assignment.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm" id="profileImage">
                                <input type="file" id="imageInput" style="display: none;" accept="image/*">
                            </div>
                            
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <!-- Admin profile details -->
                                @if (auth()->guard('admin')->check())
                                <!-- Admin profile details -->
                                <h5 class="mb-1">
                                    {{ auth()->guard('admin')->user()->firstname }} (Admin)
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    Administrator
                                </p>
                              @else
                                <h5 class="mb-1">
                                    {{ auth()->user()->firstname }}
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    CEO / Co-Founder
                                </p>
                              @endif
                            
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                            role="tab" aria-selected="true">
                                            <i class="material-icons text-lg position-relative">home</i>
                                            <span class="ms-1">App</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                            role="tab" aria-selected="false">
                                            <i class="material-icons text-lg position-relative">email</i>
                                            <span class="ms-1">Messages</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                            role="tab" aria-selected="false">
                                            <i class="material-icons text-lg position-relative">settings</i>
                                            <span class="ms-1">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- ... -->
                    </div>
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <!-- ... -->
                        </div>
                        <div class="card-body p-3">
                            <form method="POST" action="{{ route('admin-profile') }}">
                                @csrf
                                <div class="row">
                                    <!-- ... -->
                                    @if (auth()->guard('admin')->check())
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control border border-2 p-2" value="{{ old('email', auth()->guard('admin')->user()->email) }}">
                                            @error('email')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="firstname" class="form-control border border-2 p-2" value="{{ old('firstname', auth()->guard('admin')->user()->firstname) }}">
                                            @error('firstname')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="lastname" class="form-control border border-2 p-2" value="{{ old('lastname', auth()->guard('admin')->user()->lastname) }}">
                                            @error('lastname')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif
                                    <!-- ... -->
                                </div>
                                
                                <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function selectImage() {
                const inputElement = document.getElementById('imageInput');
                inputElement.click();
        
                inputElement.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    const reader = new FileReader();
        
                    reader.onload = (e) => {
                        const imgElement = document.getElementById('profileImage');
                        imgElement.src = e.target.result;
                    };
        
                    reader.readAsDataURL(file);
                });
            }
        </script>
        
</x-layout>
                               