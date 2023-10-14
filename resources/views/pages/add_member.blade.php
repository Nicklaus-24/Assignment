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
                                <h6 class="text-white text-capitalize ps-3">Member Details</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <style>
                                input[type=text]
                                {
                                    background-color:  rgb(253, 244, 244);
                                }

                                input[type=password]
                                {
                                    background-color: rgb(253, 244, 244);
                                }
                                </style>
                            <!-- Assignment form -->
                            <form method="POST" action="{{ route('store_member') }}" class="w-full max-w-2xl"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="w-full p-4">
                                    <label for="staffnumber" class="form-label">Staff Number:</label>
                                    <input type="text" id="staffnumber" name="staffnumber"
                                        class="form-control border border-black px-2 py-1 rounded" required>
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="text" id="email" name="email"
                                        class="form-control border border-black px-2 py-1 rounded" required>
                                </div>
                                <div class="w-4/4 p-4">
                                    <label for="firstname" class="form-label">First Name:</label>
                                    <input type="text" id="firstname" name="firstname"
                                        class="form-control border border-black px-2 py-1 rounded" required>
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="lastname" class="form-label">Last Name:</label>
                                    <input type="text" id="lastname" name="lastname"
                                        class="form-control border border-black px-2 py-1 rounded" required>
                                </div>

                                <div class="w-4/4 p-4">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control border border-black px-2 py-1 rounded" required>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-dark">Add Member</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

                                

                                