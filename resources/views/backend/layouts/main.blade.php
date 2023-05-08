<!DOCTYPE html>
<html lang="en">
<head>
@include('backend.layouts.head')
<style>
    table.dataTable thead th:first-child {
      border-top-left-radius: 15px;
    }
    table.dataTable thead th:last-child {
      border-top-right-radius: 15px;
    }
    .dataTables_wrapper thead th,
    table.dataTable tbody {
      text-align: center !important;
    }
    aside .active{
      background: #f39c12 !important;
      color: #fff !important;
    }

  </style>
</head>
<body class="g-sidenav-show bg-gray-100" style="height: 100vh !important;">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('backend.layouts.sidebar')
    <main class="main-content position-relative border-radius-lg " style="min-height: 100vh !important;">
        <div class="container-fluid py-4 " style="height: 100vh !important;">
            @include('backend.layouts.navbar')
            @include('backend.layouts.foot')
            @yield('conten')
            </a>
        </div>
    </main>
</body>
</html>