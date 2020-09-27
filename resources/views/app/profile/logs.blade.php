@extends('layouts.app')

@section('app.master.title', page_title('Mon journal'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Mon journal',
        'icon' => 'mdi mdi-newspaper',
        'chain' => ['Mon journal']
    ])
@endsection

@section('app.master.body')
    <div class="bg-white border rounded">
        <div class="row no-gutters">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Journal d'activités ({{ $logs->total() }})</h2>
                    </div>
                    <div class="card-body">
                        @include('partials.user-logs', compact('logs'))
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection