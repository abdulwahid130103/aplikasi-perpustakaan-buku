@extends('layout.main')

@section('title','login')

@section('conten')

<section>
    <div class="container-fluid"
    style="
    padding:0 !important;
    margin:0 !important;
    background: #5255D6 !important;
    height:100vh !important; ">
        <div class="row"  style="
        padding:0 !important;
        margin:0 !important; 
        height:100% !important;">
            <div class="col-lg-8" style="
            height:100% !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: start;
            gap:40px !important;
            padding:0 !important;
            margin:0 !important; 
            ">
                <div class="d-flex gap-4 ps-4">
                    <img height="70" src="{{ asset('images/logo.png') }}" alt="logo-login">
                    <h1 class="text-white" style="
                    font-size:30px;
                    ">Perpustakaan <br>kota kediri</h1>
                </div>
                <img style="width:100%; height:55%;" src="{{ asset('images/login-componen.png') }}" alt="login">
            </div>
            <div class="col-lg-4" style="
            background: #fff;
            display:flex;
            justify-content:center;
            align-items:center;
            ">
                <form method="POST" action="/login" style="width: 75%; font-family:'poppins-medium';">
                    @csrf
                    <h1 style="padding-bottom:2rem;" class="text-center">Login</h1>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email</label>
                      <input style="height:3rem;" name="email" type="email" 
                      class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email anda" id="exampleInputEmail1" 
                      aria-describedby="emailHelp" value="{{ old('email') }}">
                      @error('email')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input style="height:3rem; font-size:15px;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                placeholder="Masukkan password anda" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ old('password') }}">
                            <span class="input-group-text toggle-password" id="basic-addon2"><ion-icon name="eye-off-outline"></ion-icon></span>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>          
                    <div class="d-flex flex-column gap-2 justify-content-center align-items-center" style="margin: 2rem 0;">
                        <button type="submit" class="btn btn-primary"
                        style="
                        background:#5255D6 !important;
                        border-color: #5255D6 !important;
                        border-radius:20px !important;
                        padding:10px 6rem;
                        ">Masuk</button>
                        <p style="font-size: 13px;">Belum punya akun ? <a href="{{ route('register') }}">Register</a></p>
                        <a href="{{ route('auth.google') }}" class="btn btn-primary"   
                        style="background:#5255D6 !important;
                        border-color: #5255D6 !important;
                        border-radius:20px !important;
                        padding:10px 2.5rem;
                        "><ion-icon class="me-2" style="font-size:15px; transform:translateY(2px);" name="logo-google"></ion-icon>Login with Google</a>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    @if (Session::has('success'))
       toastr.success('{{ session('success') }}')
    @endif
    @if (Session::has('loginError'))
       toastr.error('{{ session('loginError') }}')
    @endif
    
    $(document).ready(function() {
        // Toggle password visibility on click
        $('.toggle-password').click(function() {
            $(this).toggleClass('eye-icon');
            var input = $($(this).attr('toggle'));
            if (input.attr('type') == 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    });
</script>
@endsection
