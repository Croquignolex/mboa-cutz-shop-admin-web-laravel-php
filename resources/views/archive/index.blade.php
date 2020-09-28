@extends('layouts.app')

@section('app.master.title', page_title('Archives'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Archives',
        'icon' => 'mdi mdi-archive',
        'chain' => ['Archives']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Admins--}}
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('archives.admins.index') }}">
                <div class="card widget-block p-4 rounded bg-primary border">
                    <div class="card-block">
                        <i class="mdi mdi-account-multiple mr-4 text-white"></i>
                        <h4 class="text-white my-2">{{ $admins }}</h4>
                        <p>Administrateurs archivés</p>
                    </div>
                </div>
            </a>
        </div>
        {{--Categories--}}
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('archives.categories.index') }}">
                <div class="card widget-block p-4 rounded bg-danger border">
                    <div class="card-block">
                        <i class="mdi mdi-database mr-4 text-white"></i>
                        <h4 class="text-white my-2">{{ $categories }}</h4>
                        <p>Catégories archivées</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection