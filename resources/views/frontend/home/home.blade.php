@extends('frontend.layouts.main')

@section('tittle',"Home")
    
@section('conten')
<style>
  .card{
    border: none;
    box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
                  rgba(0,0,0,0.3) 0px 3px 7px -3px;
  }
</style>

<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="{{ asset('images/carousel.png') }}" height="600px" class="d-block w-100" alt="konten">
      <div data-aos="fade-zoom-in"
      data-aos-easing="ease-in-back"
      data-aos-delay="100"
      data-aos-duration="1500"
      data-aos-offset="0" class="carousel-caption text-white" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <h4 class="mb-2">Selamat datang di</h4>
        <h4 class="mb-2" style="font-size: 32px;">PERPUSTAKAAN UMUM</h4>
        <h4 class="mb-5">KOTA KEDIRI</h4>
        <form method="POST" action="{{ route('searchAjax.store') }}">
          @csrf
          <div class="input-group mb-3 d-flex justify-content-center">
            <span class="input-group-text" style="background: #0ad8d2 !important; border-color:#0ad8d2; color:#fff;">
              <ion-icon name="search-outline"></ion-icon>
            </span>
            <input style="max-width: 50%; border:none !important;" 
            type="text" class="form-control" name="cari" id="cari" placeholder="Cari buku...">
            <button type="submit" class="input-group-text" style="background: #0ad8d2 !important;border-color:#0ad8d2;color:#fff;">Cari</button>
          </div>          
        </form>
      </div>
    </div>
  </div>
</div>

<section data-aos="fade-down"
  data-aos-easing="linear"
  data-aos-delay="200"
  data-aos-duration="1500" class="mb-5">
  <div class="container" style="
    max-width:40rem !important;
    max-height:100px !important;
    height:100px !important;
    transform:translateY(-50px);
    z-index: 2 !important;
    border-radius:10px;
    background:#fff;
    box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
                  rgba(0,0,0,0.3) 0px 3px 7px -3px;
    ">
    <div class="row" style=" height:100%;">
      <a style="text-decoration: none;border:2px" href="{{ route('listBukuAjax.index') }}" class="col-lg-6 d-flex justify-content-center align-items-center gap-3">
          <img src="{{ asset('images/katalog-perpus.png') }}" width="50" height="50" alt="">
          <p>Katalog Perpus</p>
      </a>
      <a style="text-decoration: none;" href="" class="col-lg-6 d-flex justify-content-center align-items-center gap-3">
        <img src="{{ asset('images/katalog-perpus.png') }}" width="50" height="50" alt="">
        <p>Perpusnas</p>
      </a>
    </div>
  </div>
</section>

{{-- Buku terbaru start --}}
<section data-aos="fade-down"
data-aos-easing="linear"
data-aos-duration="1500" class="mb-5">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col-lg-6">
        <h2 class="text-start mb-4">Buku Terbaru</h2>
      </div>
      <div class="col-lg-6">
        <a href="{{ route('listBukuAjax.index') }}">
          <p class="text-end mb-4">Lihat semua</p>
        </a>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach ($bukuTerbaru as $data)         
      <div class="col-lg-2">
        <div class="card" id="buku-{{ $data->id }}">
          <a href="{{ route('detailBukuFrontendAjax.viewDetail',$data->id) }}">
            <img src="{{ asset('storage/buku/'.$data->detailBuku->gambar) }}" style="height:220px;padding:1rem;" class="card-img-top img-fluid" alt="Gambar Buku">
          </a>
          <div class="card-body">
            <h6 class="card-title">{{ $data->judul }}</h6>
              <h6 style="display: none;" class="card-title buku-id">{{ $data->id }}</h6>
              <h6 style="display: none;" class="card-title user-id">{{Auth::user()->id }}</h6>
            <p class="card-text" style="font-size: 14px;">{{ $data->detailBuku->desc }}</p>
            <div class="d-flex justify-content-end gap-2">
              <a href="javascript:void(0)" class="btn btn-primary tombol-cart" style="border-radius:10px;background:#7158e2; border:none;"><ion-icon style="font-size: 24px;" name="bag-add-outline"></ion-icon></a>
            </div>
          </div>
        </div>        
      </div>
      @endforeach
    </div>
  </div>
</section>
{{-- Buku terbaru End --}}

{{-- Buku terlama start --}}
<section data-aos="fade-down"
data-aos-easing="linear"
data-aos-delay="100"
data-aos-duration="1500" class="mb-5">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col-lg-6">
        <h2 class="text-start mb-4">Buku Terlama</h2>
      </div>
      <div class="col-lg-6">
        <a href="{{ route('listBukuAjax.index') }}">
          <p class="text-end mb-4">Lihat semua</p>
        </a>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach ($bukuTerlama as $data)         
      <div class="col-lg-2">
        <div class="card" id="buku-{{ $data->id }}">
          <a href="{{ route('detailBukuFrontendAjax.viewDetail',$data->id) }}">
          <img src="{{ asset('storage/buku/'.$data->detailBuku->gambar) }}" style="height:220px;padding:1rem;" class="card-img-top img-fluid" alt="Gambar Buku">
          </a>
          <div class="card-body">
            <h6 class="card-title">{{ $data->judul }}</h6>
            <h6 style="display: none;" class="card-title buku-id">{{ $data->id }}</h6>
            <h6 style="display: none;" class="card-title user-id">{{Auth::user()->id }}</h6>
            <p class="card-text" style="font-size: 14px;">{{ $data->detailBuku->desc }}</p>
            <div class="d-flex justify-content-end gap-2">
              <a href="javascript:void(0)" class="btn btn-primary tombol-cart" style="border-radius:10px;background:#7158e2; border:none;"><ion-icon style="font-size: 24px;" name="bag-add-outline"></ion-icon></a>
            </div>
          </div>
        </div>        
      </div>
      @endforeach
    </div>
  </div>
</section>
{{-- Buku terlama End --}}

<script>
  
  $('.tombol-cart').click(function(){
    var idBuku = $(this).closest('.card').find('.buku-id').text();
    var idUser = $(this).closest('.card').find('.user-id').text();
    $.ajax({
        url: '/keranjangAjax',
        type:'POST',
        data:{
            user_id : idUser,
            buku_id : idBuku,
        },
        success:function(response){
          if(response.errors){
                  $.each(response.errors,function(key,value){
                      toastr.error("<li>" + value + "</li>")
                  });
          }else{
                if(response.success == null){
                  toastr.warning(response.warning)
                }else{
                  toastr.success(response.success)
                }
          }
        }
    });
  });

</script>

@endsection