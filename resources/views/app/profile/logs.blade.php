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
                        <h2>Journal d'activités</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">{{ $logs->links() }}</div>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">TITRE</th>
                                    <th scope="col">DESCRIPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $log->creation_date }}</td>
                                        <td>{{ $log->title }}</td>
                                        <td>{{ $log->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div>{{ $logs->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection