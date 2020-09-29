@extends('layouts.app')

@section('app.master.title', page_title('Détails administrateur'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails administrateur',
        'icon' => 'mdi mdi-account-multiple',
        'chain' => ['Administrateurs', 'Détails administrateur']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        @if($admin->can_edit)
                            <a class="btn btn-warning" href="{{ route('admins.edit', compact('admin')) }}">
                                <i class="mdi mdi-pencil"></i>
                                Modifier
                            </a>
                        @endif
                        @if($admin->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-admin-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    @include('partials.user-info', ['user' => $admin, 'can_update_avatar' => false])
                </div>
            </div>
        </div>
        {{--Logs--}}
        <div class="col-lg-7 col-xl-8">
            <div class="card card-default">
                <div class="card-body">
                    <h5>Journal d'activités ({{ $logs->total() }})</h5>
                    @include('partials.user-logs', compact('logs'))
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($admin->can_delete)
        @include('partials.archive-confirmation', [
            'name' => $admin->full_name,
            'modal_id' => "archive-admin-modal",
            'url' => route('admins.destroy', compact('admin'))
        ])
    @endif
@endsection