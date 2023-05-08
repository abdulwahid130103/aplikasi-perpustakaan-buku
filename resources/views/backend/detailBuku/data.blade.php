@extends('backend.layouts.main')
@section('conten')
<!-- Modal Add -->
<div class="modal fade" id="addDetailBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Detail Buku</h1>
      </div>
      <form id="addForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <label>Buku</label>
            <select name="buku_id" id="buku_id" class="form-control">
                <option id="pilih-buku" selected disabled>-- Pilih Buku --</option>
                @foreach ($dataBuku as $data)
                    <option value="{{ $data->id }}">{{ $data->judul }}</option>
                @endforeach
            </select>
            <label for="">Isbn</label>
            <input type="text" id="isbn" name="isbn" class="form-control" placeholder="Masukkan isbn buku">
            <label for="">Penerbit</label>
            <input type="text" id="penerbit" name="penerbit" class="form-control" placeholder="Masukkan penerbit buku">
            <label for="">Jumlah Halaman</label>
            <input type="number" id="jumlah_halaman" name="jumlah_halaman" 
            class="form-control" placeholder="Masukkan jumlah halaman buku">
            <label for="">Gambar</label>
            <input type="file" id="gambar" name="gambar" class="form-control">
            <label for="">Deskripsi</label>
            <textarea class="form-control" id="desc" name="desc"
            placeholder="Masukkan deskripsi buku" style="height: 100px"></textarea>
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
<div class="modal fade" id="editDetailBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
        </div>
        <form id="editForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <label>Buku</label>
                <select name="buku_id" id="buku_id" class="form-control"></select>
                <label for="">Isbn</label>
                <input type="text" id="isbn" name="isbn" class="form-control" placeholder="Masukkan isbn buku">
                <label for="">Penerbit</label>
                <input type="text" id="penerbit" name="penerbit" class="form-control" placeholder="Masukkan penerbit buku">
                <label for="">Jumlah Halaman</label>
                <input type="number" id="jumlah_halaman" name="jumlah_halaman" 
                class="form-control" placeholder="Masukkan jumlah halaman buku">
               <label for="">Old Gambar</label>
                <div>
                    <div class="x_content">
                        <div class="row">
                            <div class="thumbnail">
                                <div class="image view view-first">
                                    <img style="width: 100%; height:100%; display: block;" id="image_get"
                                        alt="image" src=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label>New Picture</label>
                <input type="file" class="form-control" name="new_picture" id="new_picture">
                <input type="hidden" name="old_picture" id="old_picture">
                <label for="">Deskripsi</label>
                <textarea class="form-control" id="desc" name="desc"
                placeholder="Masukkan deskripsi buku" style="height: 100px"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary tombol-simpan-edit">Add</button>
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
                  <th scope="col">Buku</th>
                  <th scope="col">Isbn</th>
                  <th scope="col">Penerbit</th>
                  <th scope="col">Desc</th>
                  <th scope="col">Jumlah Halaman</th>
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
          ajax: "{{ url('petugas/detailBukuAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'buku_id', name: 'buku_id'},
              {data: 'isbn', name: 'isbn'},
              {data: 'penerbit', name: 'penerbit'},
              {data: 'desc', name: 'desc'},
              {data: 'jumlah_halaman', name: 'jumlah_halaman'},
              {data:'action',name:'action', orderable: false, searchable: false}
          ]
        });
    });

    // PROSES SIMPAN 
    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#addDetailBuku').modal('show');
        $("#editForm").prop('disabled', true);
        $("#addForm").prop('disabled', false);
        
        $('.tombol-simpan').click(function() {
            var formData = new FormData($('#addForm')[0]);
            formData.append('buku_id', $('#buku_id').val());
            formData.append('isbn', $('#isbn').val());
            formData.append('penerbit', $('#penerbit').val());
            formData.append('jumlah_halaman', $('#jumlah_halaman').val());
            formData.append('desc', $('#desc').val());
            formData.append('gambar', $('input[type=file]')[0].files[0]); 
            $.ajax({
                url: '/petugas/detailBukuAjax',
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
                            $('#addDetailBuku').modal("hide");
                        }, 1000);
                }
                $('#myTable').DataTable().ajax.reload();
            }
        });
        $('#addForm').reset();
        $('#buku_id').prop('disabled', true);
        });
    });

    // PROSES EDIT 
    $('body').on('click', '.tombol-edit', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/petugas/detailBukuAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {

                $("#editForm").prop('disabled', false);
                $("#addForm").prop('disabled', true);
                $('#editDetailBuku').modal('show');
                $.each(response.dataBuku, function(key, value) {
                    $('#editForm #buku_id').append('<option value="' + value.id + '">' + value.judul + '</option>');
                    if (value.id == response.result.buku_id) {
                        $('#editForm #buku_id option[value="' + value.id + '"]').attr('selected', 'selected');
                    }
                });
                $('#editForm #image_get').attr("src","{{  asset('storage/buku/') }}"+"/"+response.result.gambar);
                $('#editForm #isbn').val(response.result.isbn);
                $('#editForm #old_picture').val(response.result.gambar);
                $('#editForm #penerbit').val(response.result.penerbit);
                $('#editForm #jumlah_halaman').val(response.result.jumlah_halaman);
                $('#editForm #desc').val(response.result.desc);

                var idNew = response.result.id;
                    
                $('.tombol-simpan-edit').click(function() {
                    var formData = new FormData($('#editForm')[0]);
                    formData.append('_method', 'PUT');
                    formData.append('buku_id', $('#editForm #buku_id').val());
                    formData.append('isbn', $('#editForm #isbn').val());
                    formData.append('penerbit', $('#editForm #penerbit').val());
                    formData.append('jumlah_halaman', $('#editForm #jumlah_halaman').val());
                    formData.append('desc', $('#editForm #desc').val());
                    formData.append('old_picture', $('#editForm #old_picture').val());
                    formData.append('new_picture', $('#editForm input[type=file]')[0].files[0]); 
                    $.ajax({
                        url: 'detailBukuAjax/' + idNew,
                        type: 'POST',
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
                                        $('#editDetailBuku').modal("hide");
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
                    url: '/petugas/detailBukuAjax/' + id,
                    type: 'DELETE',
                    success:function(response){
                        toastr.success(response.success)
                    }
                });
                $('#myTable').DataTable().ajax.reload();
            }
        })
    });

    $('#addDetailBuku').on('hidden.bs.modal',function(){
        $('#isbn').val('');
        $('#penerbit').val('');
        $('#jumlah_halaman').val('');
        $('#desc').val('');
        $('#gambar').val('');
        $('#buku_id #pilih-buku').change();
    });

    $('#addDetailBuku').on('shown.bs.modal', function () {
        // reset nilai select
        $('#buku_id').val($("#pilih-buku").val());
    });

    $('#editDetailBuku').on('hidden.bs.modal',function(){
        $('#editForm #isbn').val('');
        $('#editForm #penerbit').val('');
        $('#editForm #jumlah_halaman').val('');
        $('#editForm #desc').val('');
        $('#editForm #buku_id').empty();
    })
    </script>
@endsection
  