@extends('frontend.layouts.main')

@section('tittle',"halaman home")
    
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
  .card{
    border: none;
    box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
                  rgba(0,0,0,0.3) 0px 3px 7px -3px;
  }
  .paginate-menu > nav > .pagination > li{
    background: #fff;
    padding: 0.8rem 1.5rem;
    width: 100%;
  }
  .paginate-menu > nav > .pagination > li > a{
    background: #fff;
    color: #7158e2;
    padding: 0.8rem 1.5rem;
    width: 100%;
  }
  .paginate-menu > nav > .pagination > .active{
    background: #7158e2;
  }
  .paginate-menu > nav > .pagination > .active > span,
  .paginate-menu > nav > .pagination > .active > a{
    background: #7158e2;
    color: #fff;
  }

  .paginate-menu > nav > .pagination > li:first-child,
  .paginate-menu > nav > .pagination > li:last-child {
    background: #bdc3c7;
    padding-top: 0;
    padding-bottom: 0;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    color: #7158e2;
    font-size: 20px !important;
  }

  .paginate-menu > nav > .pagination > li:last-child {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
  }

  .paginate-menu > nav > .pagination > li:last-child > a,
  .paginate-menu > nav > .pagination > li:first-child > span,
  .paginate-menu > nav > .pagination > li:last-child > span,
  .paginate-menu > nav > .pagination > li:first-child > a{
    background: #bdc3c7;
    color: #fff;
    font-size: 30px;
  }
  .btn-group > .btn{
    background: #7158e2;
  }
</style>
<div style="margin-top: 8rem;"></div>
<div class="container">
  <div class="row">
    <div data-aos="fade-right"
    data-aos-easing="linear"
    data-aos-duration="1500" class="col-lg-4" style="padding-top: 4rem;">
      <form method="POST" action="{{ route('searchAjax.store') }}">
        @csrf
          <div class="input-group mb-3 d-flex justify-content-center">
              <span class="input-group-text" style="background: #7158e2 !important;color:#fff;">
                  <ion-icon name="search-outline"></ion-icon>
              </span>
              <input style="border-color: #7158e2;" 
              type="text" class="form-control" name="cari" placeholder="Cari buku...">
              <button type="submit" class="input-group-text" style="background: #7158e2 !important;color:#fff;">Cari</button>
              </div>        
          </div>
        </form>  
        <div data-aos="fade-left"
        data-aos-easing="linear"
        data-aos-duration="1500" class="col-lg-8">
            <div class="container">
              <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-lg-6">
                  <h2 class="text-start mb-4">Daftar Buku</h2>
                </div>
              </div>
              <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                @if ($dataBuku->isEmpty())
                <div class="col-lg-6" style="height:5rem;">
                  <div class="card d-flex justify-content-center align-items-center" style="height:5rem;">
                    Data kosong
                  </div>
                </div>
                @endif
                @foreach ($dataBuku as $data)         
                <div class="col-lg-3">
                  <div class="card">
                    <a href="{{ route('detailBukuFrontendAjax.viewDetail',$data->id) }}">
                    <img src="{{ asset('storage/buku/'.$data->detailBuku->gambar) }}" style="height:220px;padding:1rem;" class="card-img-top img-fluid" alt="Gambar Buku">
                    </a>
                    <div class="card-body">
                      <h6 class="card-title">{{ $data->judul }}</h6>
                      <p class="card-text" style="font-size: 14px;">{{ $data->detailBuku->desc }}</p>
                      <div class="d-flex justify-content-between gap-2">
                        <a href="#" class="btn btn-primary" style="width:100%; border-radius:10px;background:#7158e2; border:none;">Booking</a>
                        <a href="#" class="btn btn-primary" style="width:100%; border-radius:10px;background:#7158e2; border:none;"><ion-icon style="font-size: 24px;" name="bag-add-outline"></ion-icon></a>
                      </div>
                    </div>
                  </div>        
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        {{-- Pagination --}}
        <div class="d-flex justify-content-end paginate-menu">
            {!! $dataBuku->links() !!}
        </div>
</div>

@endsection