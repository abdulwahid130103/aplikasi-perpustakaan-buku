@extends('backend.layouts.main')
@section('conten')

<!-- Modal Add -->
<div class="modal fade" id="addAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Anggota</h1>
      </div>
      <form id="addForm">
        @csrf
        <div class="modal-body">
            <label for="">Username</label>
            <input type="text" id="username" placeholder="Masukkan username" name="username" class="form-control">
            <label for="">Email</label>
            <input type="email" id="email" placeholder="Masukkan email" name="email" class="form-control">
            <label for="">Password</label>
            <input type="password" id="password" placeholder="Masukkan password" name="password" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary tombol-simpan">Add</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Anggota</h1>
      </div>
      <form id="editForm" >
        @csrf
          <div class="modal-body">
            <label for="">Username</label>
            <input type="text" id="username" placeholder="Masukkan username" name="username" class="form-control">
            <label for="">Email</label>
            <input type="email" id="email" placeholder="Masukkan email" name="email" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary tombol-simpan-edit">Edit</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="container-fluid py-4">
    <!-- Button trigger modal -->
    <a href="javascript:void(0)" class="btn btn-primary tombol-tambah" style="padding:10px 15px;" ><ion-icon style="color:#fff !important; font-size:20px;" name="add-outline"></ion-icon></a>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <table id="myTable" class="table" 
            style="
            border-radius: 20% !important;
            ">
              <thead class="text-light" style="
              background-color:#16a085 !important;
              ">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col" width="170">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
  </div>
  
  {{-- code js --}}
  <script type="text/javascript">

    // TOKEN 
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    // SHOW TABLE
    $(document).ready(function () {
        $('#myTable').DataTable({
          processing: true,
          serverSide: true,
          "pageLength":5,
          "lengthMenu":[[5,10,20,-1],[5,10,20,"All"]],
          ajax: "{{ url('petugas/anggotaAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'username', name: 'username'},
              {data: 'email', name: 'email'},
              {data:'action',name:'action', orderable: false, searchable: false}
          ]
        });
    });

         // PROSES SIMPAN 
      $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#addAnggota').modal('show');
        $("#editForm").prop('disabled', true);
        $("#addForm").prop('disabled', false);
        $('.tombol-simpan').click(function() {
            $.ajax({
                url: '/petugas/anggotaAjax',
                type:'POST',
                data:{
                  username : $('#username').val(),
                  email : $('#email').val(),
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
                            $('#addAnggota').modal("hide");
                        }, 1000);
                }
                $('#myTable').DataTable().ajax.reload();
                }
            });
            $('#addForm').reset();
        });
    });

    // PROSES EDIT 
    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/petugas/anggotaAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $("#editForm").prop('disabled', false);
                $("#addForm").prop('disabled', true);
                $('#editAnggota').modal('show');
                $('#editAnggota #username').val(response.result.username);
                $('#editAnggota #email').val(response.result.email);

                var idNew = response.result.id;
                $('.tombol-simpan-edit').click(function() {
                    $.ajax({
                        url: 'anggotaAjax/' + idNew,
                        type:'PUT',
                        data:{
                            username : $('#editAnggota #username').val(),
                            email : $('#editAnggota #email').val()
                        },
                        success:function(response){
                            if(response.errors){
                                $.each(response.errors,function(key,value){
                                    toastr.error("<li>" + value + "</li>")
                                });
                        }else{
                                toastr.success(response.success)
                                setTimeout(function(){
                                    $('#editAnggota').modal("hide");
                                }, 1000);
                        }
                        $('#myTable').DataTable().ajax.reload();
                        }
                    });
                    $('#editForm').reset();
                });
            }
        });
    });
     // PROSES DELETE 
    $('body').on('click', '.tombol-del', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin ?',
            text: "anda ingin menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, yakin!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/petugas/anggotaAjax/' + id,
                    type: 'DELETE',
                    success:function(response){
                        toastr.success(response.success)
                    }
                });
                $('#myTable').DataTable().ajax.reload();

            }
        })
    });

    $('#addAnggota').on('hidden.bs.modal',function(){
        $('#username').val('');
        $('#email').val('');
        $('#password').val('');
    });
    </script>
@endsection
  