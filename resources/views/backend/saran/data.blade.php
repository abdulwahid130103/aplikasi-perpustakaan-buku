@extends('backend.layouts.main')
@section('conten')

<!-- Modal Add -->
<div class="modal fade" id="addRak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rak</h1>
      </div>
      <form id="addForm">
        @csrf
        <div class="modal-body">
            <label for="">Nama</label>
            <input type="text" id="nama" placeholder="Masukkan nama rak" name="nama" class="form-control">
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
<div class="modal fade" id="editRak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Rak</h1>
      </div>
      <form id="editForm" >
        @csrf
        <div class="modal-body">
            <label for="">Nama</label>
            <input type="text" id="nama-edit" placeholder="Masukkan nama rak" name="nama" class="form-control">
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
                  <th scope="col">user</th>
                  <th scope="col">Isi Saran</th>
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
          ajax: "{{ url('petugas/saranAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'user_id', name: 'user_id'},
              {data: 'isi_saran', name: 'isi_saran'},
              {data:'action',name:'action', orderable: false, searchable: false}
          ]
        });
    });
    </script>
@endsection
  