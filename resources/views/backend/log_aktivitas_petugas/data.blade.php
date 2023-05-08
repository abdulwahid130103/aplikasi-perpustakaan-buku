@extends('backend.layouts.main')
@section('conten')

<div class="container-fluid py-4">
    <!-- Button trigger modal -->
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
                  <th scope="col">User</th>
                  <th scope="col">Aktivitas</th>
                  <th scope="col">Waktu</th>
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
          ajax: "{{ url('admin/logPetugasAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'user_id', name: 'user_id'},
              {data: 'aktivitas', name: 'aktivitas'},
              {data: 'waktu', name: 'waktu'}
          ]
        });
    });
    </script>
@endsection
  