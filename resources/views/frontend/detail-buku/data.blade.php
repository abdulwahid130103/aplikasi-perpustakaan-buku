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
</style>
<div style="margin-top: 8rem;"></div>
<section class="mb-5">
    <div class="container">
        @foreach ($data as $data)
        <div class="row">
            <div class="col-lg-4 d-flex justify-content-center align-items-start">
                <div class="card" style="width: 18rem; height:25rem;">
                    <div class="card-body">
                        <img style="width: 100%; height:98%;" src="{{ asset('storage/buku/'.$data->gambar) }}" alt="gambar-buku">
                    </div>
                </div>
            </div>
            <h6 style="display:none;" class="card-title buku-id">{{ $data->id_buku }}</h6>
            <h6 style="display:none;" class="card-title user-id">{{Auth::user()->id }}</h6>
            <div class="col-lg-4 pt-4 d-flex justify-content-start flex-column">
                <h4 class="mb-3">{{ $data->judul }}</h4>
                <div class="d-flex gap-3">
                    <p>Booking buku</p>
                    <p>Deskripsi buku</p>
                    <p>Detail buku</p>
                </div>
                <div style="background:#bdc3c7; width:100%; height:1px;" class="mb-3"></div>
                <div class="flex mb-4">
                    @if ($data->stok != 0)
                    <p>Tersedia</p> 
                    @else
                    <p>Kosong</p> 
                    @endif
                    <a href="javascript:void(0)" class="btn btn-primary tombol-cart" style="border-radius:10px;background:#7158e2; border:none;"><ion-icon style="font-size: 24px;" name="bag-add-outline"></ion-icon></a>
                </div>
                <div class="d-flex flex-column mb-4">
                    <h4>Deskripsi buku</h4>
                    <p>{{ $data->desc }}</p>
                </div>
                <div class="d-flex flex-column">
                    <h4 class="mb-4">Detail buku</h4>
                    <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                            <p class="lh-1">Pengarang</p>
                            <p class="lh-1" style="color:#95a5a6; font-size:16px;">{{$data->pengarang }}</p>
                            <p class="lh-1">Penerbit</p>
                            <p class="lh-1" style="color:#95a5a6; font-size:16px;">{{$data->penerbit }}</p>
                            <p class="lh-1">ISBN</p>
                            <p class="lh-1" style="color:#95a5a6; font-size:16px;">{{$data->isbn }}</p>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                            <p class="lh-1">Tahun terbit</p>
                            <p class="lh-1" style="color:#95a5a6; font-size:16px;">{{$data->tahun_terbit }}</p>
                            <p class="lh-1">Jumlah halaman</p>
                            <p class="lh-1" style="color:#95a5a6; font-size:16px;">{{$data->jumlah_halaman }}</p>
                            <p class="lh-1">Kategori</p>
                            <p class="lh-1" style="color:#95a5a6; font-size:16px;">{{$data->nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pt-4 d-flex justify-content-start" style="position: relative;">
                <button style="
                background: none;
                color:#2c3e50;
                height:5rem;
                border-radius:15px;
                border-color:#7158e2;
                position:fixed;" class="mb-3 btn btn-primary">
                     <p>Booking buku <br> di keranjang</p>
                 </button>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section style="background-color: #fff;">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        @foreach ($dataKomen as $data)
                            <div class="d-flex flex-start align-items-start">
                                <img class="rounded-circle shadow-1-strong me-3"
                                src="{{ asset('storage/profile/'.$data->user->foto) }}" alt="avatar" width="60"
                                height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">{{ $data->user->username }}</h6>
                                    <p class="text-muted small mb-0">
                                        {{ $data->created_at }}
                                    </p>
                                    <p class="mb-4 pb-2">
                                        {{ $data->isi_comment }}
                                    </p>
                                </div>
                            </div>
                    @endforeach
                <div class="card-footer py-3 border-0" style="background: #faf9f9 !important;">
                    <form action="" id="formKomentar">
                        <div class="d-flex flex-start w-100">
                            <div class="form-outline w-100">
                                    <label class="form-label">Komentar</label>
                                    <textarea class="form-control" id="isi_comment" rows="4"
                                    style="background: #fff;"></textarea>
                            </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="button" class="btn btn-primary btn-sm simpan-komentar">Post comment</button>
                                <button type="button" class="btn btn-outline-primary btn-sm cencel-komentar">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="col-xl-4">

        </div>
      </div>
    </div>
  </section>

<script>


    
    $('.tombol-cart').click(function(){
        var idBuku = $('.buku-id').text();
        var idUser = $('.user-id').text();
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

   $('.cencel-komentar').click(function(){
        $('#isi_comment').val('');
   });
    $('.simpan-komentar').click(function(){
        var isi_comment = $('#isi_comment').val();
        var idBuku = $('.buku-id').text();
        var idUser = $('.user-id').text();
        $.ajax({
            url: '/commentAjax',
            type:'POST',
            data:{
                user_id : idUser,
                buku_id : idBuku,
                isi_comment : isi_comment,
            },
            success:function(response){
                if(response.errors){
                        $.each(response.errors,function(key,value){
                            toastr.error("<li>" + value + "</li>")
                        });
                }else{
                        window.location.reload();
                        toastr.success(response.success)
                }
            }
        });
        $('#formKomentar').reset();
    });
</script>
@endsection