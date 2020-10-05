@extends('layouts.app')

@section('app.master.title', page_title('Mon journal'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Mon journal ({$logs->total()})",
        'icon' => 'mdi mdi-newspaper',
        'chain' => ['Mon journal']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    @include('partials.user.user-logs-list', compact('logs'))
                </div>
            </div>
        </div>
    </div>
@endsection