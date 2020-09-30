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
                        <p class="text-white">Administrateurs archivés</p>
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
                        <p class="text-white">Catégories archivées</p>
                    </div>
                </div>
            </a>
        </div>
        {{--Tags--}}
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('archives.tags.index') }}">
                <div class="card widget-block p-4 rounded bg-success border">
                    <div class="card-block">
                        <i class="mdi mdi-tag-multiple mr-4 text-white"></i>
                        <h4 class="text-white my-2">{{ $tags }}</h4>
                        <p class="text-white">Etiquettes archivées</p>
                    </div>
                </div>
            </a>
        </div>
        {{--Testimonials--}}
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('archives.testimonials.index') }}">
                <div class="card widget-block p-4 rounded bg-warning border">
                    <div class="card-block">
                        <i class="mdi mdi-face mr-4 text-white"></i>
                        <h4 class="text-white my-2">{{ $testimonials }}</h4>
                        <p class="text-white">Témoignages archivées</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection