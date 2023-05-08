@extends('frontend.layouts.main')

@section('tittle',"Home")
    
@section('conten')
<style>
    .nav-item > .nav-link{
        color: #2c3e50 !important;
    }
    .navbar{
        box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
                  rgba(0,0,0,0.3) 0px 3px 7px -3px;
    }
    .navbar-brand > h6{
        color: #2c3e50 !important;
    }
    #transaksi > .container > .row > .col-md-4 > .card{
    border: none;
    width: 80%;
    box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
                  rgba(0,0,0,0.3) 0px 3px 7px -3px;
  }
</style>
<div style="margin-top: 8rem;"></div>

<section class="mb-5" id="transaksi">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-3 g-1">

        <div data-aos="fade-right"
        data-aos-easing="linear"
        data-aos-duration="1500"  class="col-md-4 text-start">
            <h4>Booking</h4>
            @if ($data1->isEmpty())           
            <div class="card mb-3 d-flex justify-content-center align-items-center" style="padding: 2rem 1rem;">
                <p>Kosong</p> 
            </div>   
            @else
                @foreach ($data1 as $i => $data)
                    <div class="card mb-3 d-flex justify-content-center align-items-center" style="padding: 2rem 1rem;">
                        <div class="card-body">    
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/buku/'.$data->gambar) }}" class="card-img-top img-fluid" alt="Gambar Buku">
                                </div>
                                <div class="col-lg-6 d-flex justify-content-start flex-column align-items-start text-start">
                                    <h6 class="card-title">{{ $data->judul }}</h6>
                                    <h6 class="card-title" style="display:none;" id="peminjaman-id">{{ $data->peminjaman_id }}</h6>
                                    <h6 class="card-title" style="display:none;" id="tgl-booking-{{ $i }}">{{ $data->tgl_booking }}</h6>
                                    <p class="card-text" style="font-size: 14px;">{{ $data->desc }}</p>
                                </div>
                            </div>   
                        </div>  
                        <div class="card-foter mt-2" id="waktu-{{ $i }}">
                            00:10:01
                        </div>
                    </div>
                @endforeach
        
            @endif
        </div>
        <div data-aos="fade-up"
        data-aos-easing="linear"
        data-aos-duration="1500" class="col-md-4 text-start">
            <h4>Peminjaman</h4>
            @if ($data2->isEmpty())           
            <div class="card mb-3 d-flex justify-content-center align-items-center" style="padding: 2rem 1rem;">
                <p>Kosong</p> 
            </div>   
            @else
                @foreach ($data2 as $data)
                    <div class="card mb-3 d-flex justify-content-center align-items-center" style="padding: 2rem 1rem;">
                        <div class="card-body">    
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/buku/'.$data->gambar) }}" class="card-img-top img-fluid" alt="Gambar Buku">
                                </div>
                                <div class="col-lg-6 d-flex justify-content-start flex-column align-items-start text-start">
                                    <h6 class="card-title">{{ $data->judul }}</h6>
                                    <h6 class="card-title">{{ $data->tgl_kembali }}</h6>
                                    <p class="card-text" style="font-size: 14px;">{{ $data->desc }}</p>
                                </div>
                            </div>   
                        </div>  
                    </div>
                @endforeach
            @endif
        </div>
        <div data-aos="fade-left"
        data-aos-easing="linear"
        data-aos-duration="1500" class="col-md-4 text-start">
            <h4>Pengembalian</h4>
            @if ($data3->isEmpty())           
            <div class="card mb-3 d-flex justify-content-center align-items-center" style="padding: 2rem 1rem;">
                <p>Kosong</p> 
            </div>   
            @else
                @foreach ($data3 as $data)
                    <div class="card mb-3 d-flex justify-content-center align-items-center" style="padding: 2rem 1rem;">
                        <div class="card-body">    
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/buku/'.$data->gambar) }}" class="card-img-top img-fluid" alt="Gambar Buku">
                                </div>
                                <div class="col-lg-6 d-flex justify-content-start flex-column align-items-start text-start">
                                    <h6 class="card-title">{{ $data->judul }}</h6>
                                    <h6 class="card-title">{{ $data->tgl_pengembalian }}</h6>
                                    <p class="card-text" style="font-size: 14px;">{{ $data->desc }}</p>
                                </div>
                            </div>   
                        </div>  
                    </div>
                @endforeach
            @endif
        </div>

      </div>
    </div>
</section>
<script>
    var x = setInterval(function() {
        var elements = document.querySelectorAll('[id^="tgl-booking-"]');
        elements.forEach(function(element) {
            var i = element.id.split("-")[2];
            var countDownDate = new Date(element.innerHTML).getTime();
            var waktuElement = document.getElementById("waktu-" + i);
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            waktuElement.innerHTML = days + "h " + hours + "j " + minutes + "m " + seconds + "d";
            var idPeminjman = $('#peminjaman-id').text();
            if (distance < 0) {
                clearInterval(x);
                $.ajax({
                    url: '/petugas/transaksiAjax/' + idPeminjman,
                    type: 'DELETE',
                    success:function(response){
                        toastr.success(response.success)
                    }
                });
            }
        });
    }, 1000);
</script>
@endsection