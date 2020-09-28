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
    <div class="bg-white border rounded">
        <div class="row no-gutters">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Details {{ $admin->full_name }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-right">
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

                        <div class="row no-gutters">
                            <div class="col-lg-5 col-xl-4">
                                <div class="profile-content-left p-4">
                                    @include('partials.user-info', [
                                        'user' => $admin,
                                        'can_update_avatar' => false
                                    ])
                                </div>
                            </div>
                            <div class="col-lg-7 col-xl-8">
                                <div class="profile-content-right p-4">
                                    <h5>Journal d'activités ({{ $logs->total() }})</h5>
                                    @include('partials.user-logs', compact('logs'))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($admin->can_delete)
        @component('components.archive-confirmation-modal', [
            'modal_id' => "archive-admin-modal",
            'url' => route('admins.destroy', compact('admin'))
        ])
            <p>
                Voulez-vous archiver <strong>{{ $admin->full_name }}</strong>?<br><br>
                Vous pouvez toujours le consulter dans la section des archives
                et le restaurer à tous moment.
            </p>
        @endcomponent
    @endif
@endsection