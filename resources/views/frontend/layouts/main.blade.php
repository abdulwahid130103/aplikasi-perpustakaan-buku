<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle')</title>
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- custom style --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css-native/main.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('dataTable/css/dataTable.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{-- datePicker air --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('datePicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        .dropdown-toggle::after {
            display: none;
        }
        .dropdown-toggle:focus {
            box-shadow: none !important;
            border-color: transparent !important;
        }
        .dropdown-toggle:not(:focus) {
            box-shadow: none !important;
            border-color: transparent !important;
        }
        .input-group > .form-control:focus {
            box-shadow: none;
            outline: none;
        }
        .input-group{
            height: 50px;
        }
        .input-group > .input-group-text:first-child{
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .input-group > .input-group-text:last-child{
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

    </style>
</head>
<body>

    <!-- Jquery -->
    <script src="{{ asset('dataTable/js/jquery.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- datePicker air js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <div class="container-fluid" style="margin:0 !important; padding:0 !important;" >
      @include('frontend/layouts/navbar')
      @yield('conten')
      @include('frontend/layouts/footer')
      <a href="javascript:void()" id="cart" data-bs-toggle="modal" class="d-flex justify-content-center align-items-center"
      style="
            position:fixed !important;
            width:55px !important;
            height:55px !important;
            border-radius:50% !important;
            right:2% !important;
            bottom:4% !important;
            z-index:999 !important;
            background: #7158e2 !important;
            box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
            rgba(0,0,0,0.3) 0px 3px 7px -3px;
            ">
        <ion-icon name="cart-outline" class="text-light" 
        style="
        width:28px !important;
        height:28px !important;
        "></ion-icon>
        </a>
      </div>
      <script src="{{ asset('datePicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
      <div style="display: none;" class="id-user">{{ Auth::user()->id }}</div>
      <!-- Modal -->
<div class="modal fade" id="cart_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Keranjang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row gap-4" id="cart_items">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <div class="d-flex justify-content-center align-items-center">
            <form action="" id="addTglBooking">
              <div class="input-group date d-flex justify-content-center align-items-center" id="datePicker">
                <input type="text" class="form-control" style="width:10rem;height:2.5rem;" placeholder="Tanggal Booking"
                aria-label="Recipient's username" aria-describedby="basic-addon2" id="tgl_booking" name="tgl_booking">
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
            </form>
          </div>
          <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary booking-buku">Booking</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    // TOKEN 
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    
    $('#cart').on('click',function(e){
      e.preventDefault();
      $('#cart_modal').modal('show');
      var id = $('.id-user').text();
      $.ajax({
        url: '/keranjangAjax/' + id + '/edit',
        type: 'GET',
        success: function(response) {
          var items = response.data;
          if(items.length == 0){
            var cartItems = $('#cart_items');
            cartItems.empty();
            var newItem = $('<div class="col-md-12">'+
              '<p style="color:#bdc3c7;">Keranjang anda kosong !!</p>'+
              '</div>');
              cartItems.append(newItem);
            }else{
              var cartItems = $('#cart_items');
              cartItems.empty();
                $.each(items, function(index, item) {
                  var newItem = $('<div class="col-md-12">' +
                    '<div class="card mb-3" id="keranjang-'+item.id_keranjang+'">' +
                      '<div class="row g-0">' +
                        '<div class="col-md-4">' +
                          '<img src="/storage/buku/' + item.gambar + '" class="img-fluid rounded-start" alt="' + item.judul + '">' +
                          '</div>' +
                          '<div class="col-md-5">' +
                            '<div class="card-body">' +
                              '<h5 class="card-title">' + item.judul + '</h5>' +
                              '<h5 style="display:none;" class="id-buku-cart">' + item.id_buku + '</h5>' +
                              '<p class="card-text">' + item.desc + '</p>' +
                              '<p style="display:none;" class="card-text keranjang-id">' + item.id_keranjang + '</p>' +
                              '</div>' +
                              '</div>' +
                              '<div class="col-md-3 d-flex flex-column">' +
                                '<div class="card-body d-flex justify-content-center align-items-center" style="height:100%;background:#7158e2;border-top-right-radius: 8px;">' +
                                  '<a href="javascript:void(0)" class="card-title cart-delete"><ion-icon style="font-size:30px; color:#fff;" name="close-outline"></ion-icon></a>' +
                                  '</div>' +
                                  '<div class="card-body d-flex justify-content-center align-items-center" style="height:100%;background:#7158e2;border-bottom-right-radius: 8px;">' +
                                    '<div class="form-check" style="transform:translateY(-5px);">'+
                                      '<input type="checkbox" class="form-check-input" id="pilih-buku" name="pilih-buku" value="'+item.id_keranjang+'">'+
                            '</div>'+
                          '</div>' +
                        '</div>' +
                      '</div>' +
                    '</div>' +
                  '</div>');
                  cartItems.append(newItem);
                });
              }
            }
          });
        });
                            
  
  
  
        var value = [];
  $('.booking-buku').on('click',function(){
    var idKeranjang = $(this).closest('.card').find('.keranjang-id').text();
    var idUser = $('.id-user').text();
    $.each($("input[name='pilih-buku']:checked"), function(){
      value.push($(this).val());
    });
    var keranjangIdEnd = value.join(', ');
    console.log(value.join(', '));
      if(value.length > 2 || $('#tgl_booking').val() == '' || value.length == 0){
        if($('#tgl_booking').val() == ''){
          toastr.error("maaf masukkan tanggal booking");
          value.splice(0, value.length);
        }else if(value.length > 2){
          toastr.error("maaf peminjaman buku maksimal 2");
          value.splice(0, value.length);
        }else{
          toastr.error("maaf anda harus select buku");
          value.splice(0, value.length);
        }
      }else{
            $.ajax({
                url: '/peminjamanAjaxFrontend',
                type:'POST',
                data:{
                    user_id : idUser,
                    keranjang_id : keranjangIdEnd,
                    tgl_booking : $('#tgl_booking').val(),
                },
                success:function(response){
                  if(response.errors){
                          $.each(response.errors,function(key,value){
                              toastr.error("<li>" + value + "</li>")
                            });
                            value.splice(0, value.length);
                  }else{
                          if(response.notif){
                            toastr.warning(response.notif)
                            value.splice(0, value.length);
                            $("input[name='pilih-buku']:checked").prop('checked', false);
                            $('#tgl_booking').val('');
                          }else{
                            toastr.success(response.success)
                            value.splice(0, value.length);
                            $("input[name='pilih-buku']:checked").prop('checked', false);
                            $('#tgl_booking').val('');
                          }
                          setTimeout(function(){
                              $('#cart_modal').modal("hide");
                          }, 1000);
                  }
                }
            });
            $('#addTglBooking').reset();
      }
    });
    
    // PROSES DELETE 

    $('body').on('click', '.cart-delete', function(e) {
      e.preventDefault();
      var idKeranjang = $(this).closest('.card').find('.keranjang-id').text();
      Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "anda ingin menghapus buku ini dari keranjang",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'iya, yakin!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/keranjangAjax/' + idKeranjang,
            type: 'DELETE',
            success:function(response){
              toastr.success(response.success)
              setTimeout(function(){
                $('#cart_modal').modal("hide");
              }, 100)
            }
          });
        }
      })
    });
    
    //  $('#select-all').on('click',function(){
      //    $("input[name='pilih-buku']:checked").prop('checked', false);
      //  });

    // datePicker
    $(function(){
        $('#datePicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            clearBtn: true,
            orientation: 'top'
        });
    });

    $('#cart_modal').on('hidden.bs.modal',function(){
        $('#tgl_booking').val('');
    });
      </script>


</body>
</html>