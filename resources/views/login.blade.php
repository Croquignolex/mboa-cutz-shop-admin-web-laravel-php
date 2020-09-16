@extends('master')

@section('master.title', 'Connexion')

@section('master.class', 'bg-theme-dark')

@section('master.body')
    <div class="container d-flex flex-column justify-content-center vh-100">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-header bg-theme-dark">
                        <div class="app-brand">
                            <img src="{{ img_asset('logo', 'jpg') }}" alt="..." width="70">
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="text-dark mb-3">Connexion</h4>
                        <form action="" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" class="form-control input-lg" id="email" placeholder="Email" value="{{ old('email') }}" name="email"/>
                                    <label for="email">
                                        @if ($errors->has('email'))
                                            <small class="text-danger">
                                                {{ $errors->first('email') }}
                                            </small>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group col-md-12 ">
                                    <input type="password" class="form-control input-lg" id="password" placeholder="Mot de passe" value="{{ old('password') }}" name="password"/>
                                    <label for="password">
                                        @if ($errors->has('password'))
                                            <small class="text-danger">
                                                {{ $errors->first('password') }}
                                            </small>
                                        @endif
                                    </label>
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ css_asset('sleek') }}" type="text/css">
@endpush