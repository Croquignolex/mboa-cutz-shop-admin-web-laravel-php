@extends('master')

@section('master.title', 'Connexion')

@section('master.body')
    <div class="container d-flex flex-column justify-content-between vh-100">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-header bg-theme-dark">
                        <div class="app-brand text-center">
                            <img src="{{ img_asset('logo', 'jpg') }}" alt="..." width="70">
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="text-dark mb-3">Connexion</h4>
                        <form action="">
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" placeholder="Username">
                                </div>
                                <div class="form-group col-md-12 ">
                                    <input type="password" class="form-control input-lg" id="password" placeholder="Password">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-theme-dark btn-block mb-4">
                                        Connexion
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright pl-0">
            <p class="text-center">
                Copyright &copy; MBOA CUTZ 2020 | Design by
                <a href="https://croquignolex-tikiton.dmsemergence.com/"
                   class="text-white"
                   target="_blank"
                >
                    Croquignolex Tikiton
                </a>
            </p>
        </div>
    </div>
@endsection

@push('master.style')
    <link rel="stylesheet" href="{{ css_asset('toastr.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('nprogress') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('flag-icon.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('jquery-jvectormap-2.0.3') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('ladda.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('select2.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('daterangepicker') }}" type="text/css">
@endpush