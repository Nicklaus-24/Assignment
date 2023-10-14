<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
       
        
       

        <div class="container-fluid py-2">
           <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Notifications</h4>
                                
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <ul>
                                @foreach(auth()->user()->notifications as $notification)
                                 <div class="alert alert-warning alert-dismissible text-white" role="alert">
                                    <div class="notification">
                                     <span class="text-sm">{{ $notification->data['message'] }} <a href="javascript:;"
                                            class="alert-link text-white">an example link</a>. Check it out</span>
                                     <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                     </button>
                                    </div>
                                 </div>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </main>
</x-layout>