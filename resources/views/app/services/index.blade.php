@extends('layouts.app')

@section('app.master.title', page_title('Services'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Services ({$services->total()})",
        'icon' => 'mdi mdi-shopping',
        'chain' => ['Services']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('services.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouveau service
                        </a>
                    </div>
                    @include('partials.services-list', ['actions' => true])
                </div>
            </div>
        </div>
    </div>
@endsection
