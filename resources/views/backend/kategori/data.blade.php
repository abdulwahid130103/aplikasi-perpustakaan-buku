@extends('backend.layouts.main')
@section('conten')
<!-- Modal Add -->
<div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Kategori</h1>
      </div>
      <form id="addForm">
        @csrf
        <div class="modal-body">
            <label for="">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama kategori" class="form-control">
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
<div class="modal fade" id="editKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
      </div>
      <form id="editForm" >
        @csrf
        <div class="modal-body">   
            <label for="">Nama</label>
            <input type="text" id="nama-edit" placeholder="Masukkan nama kategori" name="nama" class="form-control">
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
                  <th scope="col">Name</th>
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
          ajax: "{{ url('petugas/kategoriAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'nama', name: 'nama'},
              {data:'action',name:'action', orderable: false, searchable: false}
          ]
        });
    });

     // PROSES SIMPAN 
    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#addKategori').modal('show');
        $("#editForm").prop('disabled', true);
        $("#addForm").prop('disabled', false);
        $('.tombol-simpan').click(function() {
            $.ajax({
                url: '/petugas/kategoriAjax',
                type:'POST',
                data:{
                    nama : $('#nama').val()
                },
                success:function(response){
                    if(response.errors){
                        $.each(response.errors,function(key,value){
                            toastr.error("<li>" + value + "</li>")
                        });
                }else{
                        toastr.success(response.success)
                        setTimeout(function(){
                            $('#addKategori').modal("hide");
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
            url: '/petugas/kategoriAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $("#editForm").prop('disabled', false);
                $("#addForm").prop('disabled', true);
                $('#editKategori').modal('show');
                $('#nama-edit').val(response.result.nama);
                var idNew = response.result.id;
                $('.tombol-simpan-edit').click(function() {
                    $.ajax({
                        url: 'kategoriAjax/' + idNew,
                        type:'PUT',
                        data:{
                            nama : $('#nama-edit').val()
                        },
                        success:function(response){
                            if(response.errors){
                                $.each(response.errors,function(key,value){
                                    toastr.error("<li>" + value + "</li>")
                                });
                        }else{
                                toastr.success(response.success)
                                setTimeout(function(){
                                    $('#editKategori').modal("hide");
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

     // 04_PROSES Delete 
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
                    url: '/petugas/kategoriAjax/' + id,
                    type: 'DELETE',
                    success:function(response){
                        toastr.success(response.success)
                    }
                });
                $('#myTable').DataTable().ajax.reload();

            }
        })
    });

    $('#addKategori').on('hidden.bs.modal',function(){
        $('#nama').val('');
    });
      
    </script>
@endsection
  