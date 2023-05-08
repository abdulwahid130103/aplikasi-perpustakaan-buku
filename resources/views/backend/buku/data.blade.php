@extends('backend.layouts.main')
@section('conten')
<!-- Modal Show -->
<div class="modal fade" id="showBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-2" id="exampleModalLabel"></h1>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </div>
       <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <img id="img-show" src="" style="width:100%; height:300px;" alt="">
                </div>
                <div class="col-lg-6 d-flex justify-content-start align-items-center column">
                    <p>Judul : </p>
                    <p id="judul-show"></p>
                </div>
                <div class="col-lg-6 d-flex justify-content-start align-items-center column">
                    <p>Isbn : </p>
                    <p id="isbn-show"></p>
                </div>
                <div class="col-lg-6 d-flex justify-content-start align-items-center column">
                    <p>Penerbit : </p>
                    <p id="penerbit-show"></p>
                </div>
                <div class="col-lg-6 d-flex justify-content-start align-items-center column">
                    <p>Jumlah Halaman : </p>
                    <p id="jumlah-show"></p>
                </div>
                <div class="col-lg-12 d-flex justify-content-start align-items-center">
                    <p>Deskripsi : </p>
                    <p id="desc-show"></p>
                </div>
            </div>
        </div>
       </div>
    </div>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Buku</h1>
      </div>
      <form id="addForm">
        @csrf
        <div class="modal-body">
            <label for="">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul buku">
            <label for="">Pengarang</label>
            <input type="text" id="pengarang" name="pengarang" class="form-control" placeholder="Masukkan pengarang buku">
            <label for="">Tahun Terbit</label>
            <div class="input-group date" id="datePicker">
                <input type="text" class="form-control" placeholder="Pilih tahun terbit"
                 aria-label="Recipient's username" aria-describedby="basic-addon2" id="tahun_terbit" name="tahun_terbit">
                 <span class="input-group-append">
                     <span class="input-group-text" id="basic-addon2" >
                         <ion-icon name="calendar-outline"
                         style="
                             width:25px !important;
                             height:25px !important;
                         ">
                         </ion-icon>
                     </span>
                 </span>
            </div>
            <label for="">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" placeholder="Masukkan stok buku">
            <label>Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control">
                <option id="pilih-kat" selected disabled>-- Pilih Kategori --</option>
                @foreach ($dataKategori as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
            </select>
            <label for="">rak_id</label>
            <select name="rak_id" id="rak_id" class="form-control">
                <option id="pilih-rak" selected disabled>-- Pilih Rak --</option>
                @foreach ($dataRak as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
            </select>
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
<div class="modal fade" id="editBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
      </div>
      <form id="editForm" >
        @csrf
        <div class="modal-body">
            <label for="">Judul</label>
            <input type="text" id="judul-edit" name="judul" class="form-control" placeholder="Masukkan judul buku">
            <label for="">Pengarang</label>
            <input type="text" id="pengarang-edit" name="pengarang" class="form-control" placeholder="Masukkan pengarang buku">
            <label for="">Tahun Terbit</label>
            <div class="input-group date" id="datePicker-edit">
                <input type="text" class="form-control" placeholder="Pilih tahun terbit"
                 aria-label="Recipient's username" aria-describedby="basic-addon2" id="tahun_terbit-edit" name="tahun_terbit">
                 <span class="input-group-append">
                     <span class="input-group-text" id="basic-addon2" >
                         <ion-icon name="calendar-outline"
                         style="
                             width:25px !important;
                             height:25px !important;
                         ">
                         </ion-icon>
                     </span>
                 </span>
            </div>
            <label for="">Stok</label>
            <input type="number" id="stok-edit" name="stok" class="form-control" placeholder="Masukkan stok buku">
            <label>Kategori</label>
            <select name="kategori_id" id="kategori_id-edit" class="form-control">
            </select>
            <label for="">rak_id</label>
            <select name="rak_id" id="rak_id-edit" class="form-control">
            </select>
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
                  <th scope="col">judul</th>
                  <th scope="col">Pengarang</th>
                  <th scope="col">Tahun Terbit</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Rak</th>
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

    // datePicker
    $(function(){
        $('#datePicker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
            clearBtn: true,
            orientation: 'bottom'
        });
    });

    $(function(){
        $('#datePicker-edit').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
            clearBtn: true,
            orientation: 'bottom'
        });
    });

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
          ajax: "{{ url('petugas/bukuAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'judul', name: 'judul'},
              {data: 'pengarang', name: 'pengarang'},
              {data: 'tahun_terbit', name: 'tahun_terbit'},
              {data: 'stok', name: 'stok'},
              {data: 'kategori_id', name: 'kategori_id'},
              {data: 'rak_id', name: 'rak_id'},
              {data:'action',name:'action', orderable: false, searchable: false}
          ]
        });
    });

    // PROSES Show 
    $('body').on('click', '.show-buku', function(e) {
        e.preventDefault();
        $('#showBuku').modal('show');
        var id = $(this).data('id');
        $.ajax({
                url: '/petugas/bukuAjax/' + id,
                type:'GET',
                success:function(response){
                    $('#judul-show').html(response.dataBuku.judul);
                    $('#isbn-show').html(response.result.desc);
                    $('#penerbit-show').html(response.result.penerbit);
                    $('#jumlah-show').html(response.result.jumlah_halaman);
                    $('#img-show').attr("src","{{  asset('storage/buku/') }}"+"/"+response.result.gambar);
                    $('#desc-show').html(response.result.desc);
                }
        });
        
    });

    // PROSES SIMPAN 
    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#addBuku').modal('show');
        $("#editForm").prop('disabled', true);
        $("#addForm").prop('disabled', false);
        
        $('.tombol-simpan').click(function() {
            $.ajax({
                url: '/petugas/bukuAjax',
                type:'POST',
                data:{
                    judul : $('#judul').val(),
                    pengarang : $('#pengarang').val(),
                    tahun_terbit : $('#tahun_terbit').val(),
                    stok : $('#stok').val(),
                    kategori_id : $('#kategori_id').val(),
                    rak_id : $('#rak_id').val()
                },
                success:function(response){
                    if(response.errors){
                        $.each(response.errors,function(key,value){
                            toastr.error("<li>" + value + "</li>")
                        });
                    }else{
                        toastr.success(response.success)
                        setTimeout(function(){
                            $('#addBuku').modal("hide");
                        }, 1000);
                }
                $('#myTable').DataTable().ajax.reload();
            }
        });
        $('#addForm').reset();
        $('#kategori_id').prop('disabled', true);
        $('#rak_id').prop('disabled', true);
        });
    });

      // PROSES EDIT 
    $('body').on('click', '.tombol-edit', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/petugas/bukuAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {

                $("#editForm").prop('disabled', false);
                $("#addForm").prop('disabled', true);
                $('#editBuku').modal('show');
                $.each(response.dataKategori, function(key, value) {
                    $('#kategori_id-edit').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    if (value.id == response.result.kategori_id) {
                        $('#kategori_id-edit option[value="' + value.id + '"]').attr('selected', 'selected');
                    }
                });
                $.each(response.dataRak, function(key, value) {
                    $('#rak_id-edit').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    if (value.id == response.result.rak_id) {
                            $('#rak_id-edit option[value="' + value.id + '"]').attr('selected', 'selected');
                        }
                    });
                    
                    $('#judul-edit').val(response.result.judul);
                    $('#pengarang-edit').val(response.result.pengarang);
                    $('#tahun_terbit-edit').val(response.result.tahun_terbit);
                    $('#stok-edit').val(response.result.stok);

                    var idNew = response.result.id;
                    
                    $('.tombol-simpan-edit').click(function() {
                    e.preventDefault();
                    $.ajax({
                        url: 'bukuAjax/' + idNew,
                        type:'PUT',
                        data:{
                            judul : $('#judul-edit').val(),
                            pengarang : $('#pengarang-edit').val(),
                            tahun_terbit : $('#tahun_terbit-edit').val(),
                            stok : $('#stok-edit').val(),
                            kategori_id : $('#kategori_id-edit').val(),
                            rak_id : $('#rak_id-edit').val()
                        },
                        success:function(response){
                            if(response.errors){
                                $.each(response.errors,function(key,value){
                                    toastr.error("<li>" + value + "</li>")
                                });
                        }else{
                                toastr.success(response.success)
                                setTimeout(function(){
                                    $('#editBuku').modal("hide");
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
                    url: '/petugas/bukuAjax/' + id,
                    type: 'DELETE',
                    success:function(response){
                        toastr.success(response.success)
                    }
                });
                $('#myTable').DataTable().ajax.reload();

            }
        })
    });

    $('#addBuku').on('hidden.bs.modal',function(){
        $('#judul').val('');
        $('#pengarang').val('');
        $('#tahun_terbit').val('');
        $('#stok').val('');
        $('#kategori_id #pilih-kat').change();
        $('#rak_id #pilih-rak').change();
    });

    $('#addBuku').on('shown.bs.modal', function () {
        // reset nilai select
        $('#kategori_id').val($("#pilih-kat").val());
        $('#rak_id').val($("#pilih-rak").val());
    });

    $('#editBuku').on('hidden.bs.modal',function(){
        $('#judul-edit').val('');
        $('#pengarang-edit').val('');
        $('#tahun_terbit-edit').val('');
        $('#stok-edit').val('');
        $('#kategori_id-edit').empty();
        $('#rak_id-edit').empty();
    });
    </script>
@endsection
  