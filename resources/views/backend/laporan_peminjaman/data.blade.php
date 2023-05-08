@extends('backend.layouts.main')
@section('conten')


<div class="container-fluid py-4">
    <!-- Button trigger modal -->
    <a href="{{ route('excelPeminjaman') }}" class="btn btn-success tombol-tambah" style="padding:10px 15px; background:#16a085;" ><ion-icon style="color:#fff !important; font-size:20px; transform:translateY(2px);" name="download-outline"></ion-icon> Excell</a>
    <a href="javascript:void(0)" id="export-pdf-btn" class="btn btn-primary tombol-tambah" style="padding:10px 15px; background:#d35400;" ><ion-icon style="color:#fff !important; font-size:20px; transform:translateY(2px);" name="download-outline"></ion-icon> PDF</a>
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
                  <th scope="col">Buku</th>
                  <th scope="col">Tanggal Pinjam</th>
                  <th scope="col">Tanggal Kembali</th>
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
          ajax: "{{ url('admin/laporanPeminjamanAjax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'user_id', name: 'user_id'},
              {data: 'buku_id', name: 'buku_id'},
              {data: 'tgl_pinjam', name: 'tgl_pinjam'},
              {data: 'tgl_kembali', name: 'tgl_kembali'},
          ]
        });
    });

        $('#export-pdf-btn').click(function() {
              var columns = ["No","ID", "User", "Buku","Tanggal Pinjam","Tanggal Kembali","Status"];
              var rows = [];
              var table = $('#myTable').DataTable();
              table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                var data = this.data();
                rows.push([
                  data['DT_RowIndex'],
                  data['id'],
                  data['user_id'], 
                  data['buku_id'], 
                  data['tgl_pinjam'],
                  data['tgl_kembali'],
                  data['status']
                ]);
              });
              var doc = new jsPDF('p', 'pt');
              doc.autoTable(columns, rows);
              doc.save('Peminjaman.pdf');
        });
    </script>
@endsection
  