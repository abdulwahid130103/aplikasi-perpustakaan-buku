<style>
      .navbar-toggler:focus {
          box-shadow: none !important;
          border-color: transparent !important;
      }
      .navbar-toggler:not(:focus) {
          box-shadow: none !important;
          border-color: transparent !important;
      }
</style>
@if (Auth::user())
<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" enctype="multipart/form-data">
          <input type="hidden" value="{{ Auth::user()->id }}" id="id_user">
          <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="mb-4 d-flex flex-column justify-content-center align-items-center gap-3" style="width: 100%;">
              <img class="ms-2" src="" id="img-show" style="width:180px; height:180px; border-radius:50%;" alt="">
              <input style="width: 70%;" type="file" class="form-control" name="new_picture" id="new_picture" >
              <input type="hidden" name="old_picture" id="old_picture">
            </div>
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username anda...">
            </div>
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda...">
            </div>
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">Tanggal Lahir</label>
              <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan tanggal lahir anda...">
            </div>
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat anda...">
            </div>
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan no telepon anda...">
            </div>
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">Jenis Kelamin</label>
              <select class="form-select" id="jk" name="jk" style="width: 100% !important;">
                <option selected disabled>-- Pilih JK --</option>
                <option value="pria">Laki Laki</option>
                <option value="wanita">Perempuan</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary tombol-simpan-edit">Update Profile</button>
      </div>
    </div>
  </div>
</div>
@endif

@if (Auth::user())
<!-- Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editPassword">
            <input type="hidden" value="{{ Auth::user()->id }}" id="user-id">
            <div class="mb-1 d-flex flex-column justify-content-start align-items-start" style="width: 100%;">
              <label class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password baru anda...">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary tombol-edit-password">Update Password</button>
      </div>
    </div>
  </div>
</div>
@endif

<nav data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000"
data-aos-easing="ease-in-out" class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top navbar-light">
    <div  class="container con-nv">
      <a class="navbar-brand d-flex justify-content-center align-items-center gap-3" href="{{ route('home') }}">
        <img src="{{  asset('images/logo.png') }}" 
        alt="logo"
        class="logo" 
        width="50px" 
        height="42px"> 
        <h6 class="font-weight-bolder text-white mb-0">
          Perpustakaan umum <br>kota kediri
          </h6>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <ion-icon style="color:#fff; font-size:28px;" name="filter-outline"></ion-icon>
      </button>   
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto text-white ctn-nav">
          <li class="nav-item lg-mx-2">
            <a class="nav-link {{ Request::is('home') ? 'active' : '' }} text-white" href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="nav-item lg-mx-2">
            <a class="nav-link {{ (Request::is('listBukuAjax') || Request::is('detailBukuFrontendAjax/viewDetail/*')) ? 'active' : '' }} text-white" href="{{ route('listBukuAjax.index') }}">Katalog buku</a>
          </li>
          <li class="nav-item lg-mx-1">
            <a class="nav-link text-white {{ Request::is('transaksiAjax') ? 'active' : '' }}" href="{{ route('transaksiAjax.index') }}">Transaksi</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          @if (!Auth::user()) 
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">
                <button class="btn btn-primary btn-daftar d-flex flex-row" type="button">
                  <ion-icon name="log-in-outline" class="icon-daftar"></ion-icon>
                  <span>Masuk</span>
                </button>
              </a>
            </li>
            @else
            <li id="dropdown-navbar" class="nav-item dropdown" style="transform: translateY(-2px)">
              <button id="usm-nv" class="nav-link btn text-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" value="">
                {{ ucwords(Auth::user()->username) }}
               <img class="ms-2" src="{{ asset('storage/profile/'.Auth::user()->foto) }}" id="profile-new" 
               style="width:30px; height:30px; border-radius:50%;" alt="">
              </button>
              <ul class="dropdown-menu dropdown-menu-light">
                <li>
                  <a class="dropdown-item" id="modal" href="javascript:void(0)">
                    <ion-icon style="transform: translateY(2px);" class="me-2" name="person-outline"></ion-icon>
                    Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" id="ganti_password" href="javascript:void(0)">
                    <ion-icon style="transform: translateY(2px);" class="me-2" name="person-outline"></ion-icon>
                    Ganti Password
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ url('/logout') }}">
                    <ion-icon style="transform: translateY(2px);" class="me-2" name="log-out-outline"></ion-icon>
                    Logout
                  </a>
                </li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <script type="text/javascript">
    // TOKEN 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.onscroll = function(){
      const header = document.querySelector('.navbar');
      const fixedNav = header.offsetTop;

      if(window.pageYOffset > fixedNav){
        $('.navbar').addClass('header');
        $('.navbar > .container').removeClass('con-nv');
        $('.nav-item > .nav-link').removeClass('text-white');
        $('.nav-item > .nav-link').addClass('text-dark');
        $('.navbar-brand > h6').removeClass('text-white');
        $('.navbar-brand > h6').addClass('text-dark');
        $('.navbar-brand > .nav-item > .nav-link >button').replace('text-dark')
      }else{
        $('.navbar').removeClass('header');
        $('.navbar > .container').addClass('con-nv');
        $('.nav-item > .nav-link').addClass('text-white');
        $('.nav-item > .nav-link').removeClass('text-dark');
        $('.navbar-brand > h6').addClass('text-white');
        $('.navbar-brand > h6').removeClass('text-dark');
      }
    }

    $('#modal').click(function(e){
      e.preventDefault();
      var id = $('#id_user').val();
        $.ajax({
            url: '/homeAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
              $("#editForm").prop('disabled', false);
              $('#profileModal').modal('show');
              $('#username').val(response.result.username);
              $('#img-show').attr("src","{{  asset('storage/profile/') }}"+"/"+response.result.foto);
              $('#email').val(response.result.email);
              $('#tgl_lahir').val(response.result.tgl_lahir);
              $('#alamat').val(response.result.alamat);
              $('#no_telp').val(response.result.no_telp);
              if(response.result.jk != null){
                $('#jk').val(response.result.jk).prop('selected', true);
              }
              
              $('#old_picture').val(response.result.foto);
                var idNew = response.result.id;
                $('.tombol-simpan-edit').click(function() {
                  var formData = new FormData($('#editForm')[0]);
                    formData.append('_method', 'PUT');
                    formData.append('username', $('#editForm #username').val());
                    formData.append('email', $('#editForm #email').val());
                    formData.append('tgl_lahir', $('#editForm #tgl_lahir').val());
                    formData.append('alamat', $('#editForm #alamat').val());
                    formData.append('no_telp', $('#editForm #no_telp').val());
                    formData.append('jk', $('#editForm #jk').val());
                    formData.append('old_picture', $('#editForm #old_picture').val());
                    formData.append('new_picture', $('#editForm input[type=file]')[0].files[0]); 
                    $.ajax({
                        url: 'homeAjax/' + idNew,
                        type:'POST',
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success:function(response){
                          if(response.errors){
                                  $.each(response.errors,function(key,value){
                                      toastr.error("<li>" + value + "</li>")
                                  });
                          }else{
                                  toastr.success(response.success)
                                  setTimeout(function(){
                                      $('#profileModal').modal("hide");
                                  }, 500);
                                  console.log(response.data.foto);
                                  $('#profile-new').attr("src","{{  asset('storage/profile/') }}"+"/"+response.result.foto);
                                  $('#usm-nv').text(response.data.username);
                          }
                        }
                    });
                    $('#editForm').reset();
                });
            }
        });
    });

    $('#profileModal').on('hidden.bs.modal',function(){
        $('#editForm #username').val('');
        $('#editForm #email').val('');
        $('#editForm #tgl_lahir').val('');
        $('#editForm #alamat').val('');
        $('#editForm #no_telp').val('');
    });

    $('#ganti_password').click(function(e){
      e.preventDefault();
      var id = $('#user-id').val();
        $.ajax({
            url: '/profileAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
              $("#editPassword").prop('disabled', false);
              $('#passwordModal').modal('show');
                var idNew = response.result.id;
                $('.tombol-edit-password').click(function() { 
                    $.ajax({
                        url: 'profileAjax/' + idNew,
                        type:'PUT',
                        data: {
                          password : $('#password').val()
                        },
                        success:function(response){
                          if(response.errors){
                                  $.each(response.errors,function(key,value){
                                      toastr.error("<li>" + value + "</li>")
                                  });
                          }else{
                                  toastr.success(response.success)
                                  setTimeout(function(){
                                      $('#passwordModal').modal("hide");
                                  }, 500);
                                  $('#password').val('');
                          }
                        }
                    });
                    $('#editPassword').reset();
                });
            }
        });
    });
    
    $('#passwordModal').on('hidden.bs.modal',function(){
        $('#password').val('');
    });
  </script>