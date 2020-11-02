@extends('layouts.app')

@section('app.master.title', page_title('Articles'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Articles ({$articles->total()})",
        'icon' => 'mdi mdi-blinds',
        'chain' => ['Articles']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('articles.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouvel article
                        </a>
                    </div>
                    @include('partials.articles.articles-list', ['actions' => true])
                </div>
            </div>
        </div>
    </div>
@endsection
