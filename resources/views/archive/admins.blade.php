@extends('layouts.app')

@section('app.master.title', page_title('Administrateurs archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Administrateurs archivés ({$admins->total()})",
        'icon' => 'mdi mdi-account-multiple',
        'chain' => ['Archives', 'Administrateurs archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $admins->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">AVATAR</th>
                                <th scope="col">ROLE</th>
                                <th scope="col">PRENOM</th>
                                <th scope="col">NOM</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">TELEPHONE</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->creation_date }}</td>
                                    <td class="text-center">
                                        <img class="rounded-circle w-45" src="{{ $admin->avatar_src }}" alt="..." />
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-{{ $admin->role->badge_color }}">
                                            {{ $admin->role->name }}
                                        </span>
                                    </td>
                                    <td>{{ $admin->format_first_name }}</td>
                                    <td>{{ $admin->format_last_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->creator_name}}</td>
                                    <td class="text-center">
                                        @if($admin->can_delete)
                                            <button class="btn btn-sm btn-success"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$admin->slug-restore-admin-modal" }}"
                                                    title="Restorer"
                                            >
                                                <i class="mdi mdi-backup-restore"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($admin->can_delete)
                                    @include('partials.restore-confirmation', [
                                        'name' => $admin->full_name,
                                        'modal_id' => "$admin->slug-restore-admin-modal",
                                        'url' => route('archives.admins.restore', compact('admin'))
                                    ])
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $admins->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection