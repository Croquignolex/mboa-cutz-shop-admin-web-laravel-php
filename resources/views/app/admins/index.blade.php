@extends('layouts.app')

@section('app.master.title', page_title('Administrateurs'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Administrateurs',
        'icon' => 'mdi mdi-account-multiple',
        'chain' => ['Administrateurs']
    ])
@endsection

@section('app.master.body')
    <div class="bg-white border rounded">
        <div class="row no-gutters">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Les administrateurs</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class="btn btn-primary" href="{{ route('admins.create') }}">
                                <i class="mdi mdi-plus"></i>
                                Nouvel administrateur
                            </a>
                        </div>

                        <div class="mb-3">{{ $admins->links() }}</div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">AVATAR</th>
                                    <th scope="col">ROLE</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">TELEPHONE</th>
                                    <th scope="col">PRENOM</th>
                                    <th scope="col">NOM</th>
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
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->format_first_name }}</td>
                                        <td>{{ $admin->format_last_name }}</td>
                                        <td class="text-center">
                                            @if($admin->can_show)
                                                <a href="{{ route('admins.show', compact('admin')) }}" class="btn btn-sm btn-primary">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                            @endif
                                            @if($admin->can_edit)
                                                <a href="{{ route('admins.edit', compact('admin')) }}" class="btn btn-sm btn-warning">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            @endif
                                            @if($admin->can_delete)
                                                <button class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$admin->slug-delete-admin-modal" }}"
                                                >
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @component('components.modal', [
                                        'modal_id' => "$admin->slug-delete-admin-modal",
                                        'modal_size' => '',
                                        'modal_title' => "Supprimer $admin->full_name",
                                    ])
                                        <div class="bg-danger text-white p-3 mb-3">
                                             description
                                        </div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-light ml-1 mr-1" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-primary ml-1 mr-1" id="modal-save-image">
                                                <i class="mdi mdi-check"></i>
                                                Enrégistrer
                                            </button>
                                        </div>
                                    @endcomponent
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>{{ $admins->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection