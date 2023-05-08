

  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
       data-scroll="false">
       <div class="container-fluid py-1 px-3">
           <nav aria-label="breadcrumb">
               <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                   <li class="breadcrumb-item text-sm">
                       <a class="opacity-5 text-white" href="javascript:;">Pages</a>
                   </li>
                   <li class="breadcrumb-item text-sm text-white" aria-current="page">
                    {{ ucfirst(basename(Request::path())) ?: 'Dashboard' }}
                   </li>
               </ol>
               <h6 class="font-weight-bolder text-white mb-0">
                {{ ucfirst(basename(Request::path())) ?: 'Dashboard' }}
               </h6>
           </nav>
           <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
               <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
                <ul class="navbar-nav justify-content-end">
                   <li class="nav-item px-3 d-flex align-items-center">
                       <a href="javascript:;" class="nav-link text-white p-0">
                         <span class="d-sm-inline d-none me-1">{{ Auth::user()->username }}</span>
                         <i style="font-size: 18px;" class="fa fa-user me-sm-1 fixed-plugin-button-nav cursor-pointer"></i>
                       </a>
                   </li>
               </ul>
           </div>
       </div>
   </nav>
   <!-- End Navbar -->

   <div class="fixed-plugin">
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
            <div class="float-start">
              <h5 class="mt-3 mb-0 d-flex justify-content-center align-items-center gap-3 "><ion-icon name="settings-outline"></ion-icon>Setting</h5>
            </div>
            <div class="float-end mt-4">
                <button
                    class="btn btn-link text-dark p-0 fixed-plugin-close-button"
                >
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1" />
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
            {{-- <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div> --}}
            <div class="d-flex flex-column text-start">
                <a href="{{ url('/logout') }}" class="btn bg-gradient-primary w-100 px-3 mb-2 active d-flex gap-2 justify-content-center align-items-center" data-class="bg-default"><ion-icon name="log-out-outline"></ion-icon>Logout</a>
            </div>
            <div class="w-100 text-center">
              
            </div>
        </div>
    </div>
</div>