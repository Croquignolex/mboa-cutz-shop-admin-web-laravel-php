@extends('layouts.app')

@section('app.master.title', page_title('Clients archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Clients archivés ({$customers->total()})",
        'icon' => 'mdi mdi-account-group',
        'chain' => ['Archives', 'Clients archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $customers->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                    <th scope="col">CREATION</th>
                                <th scope="col">AVATAR</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">PRENOM</th>
                                <th scope="col">NOM</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">TELEPHONE</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                        <td style="white-space: nowrap;">{{ $customer->creation_date }}</td>
                                    <td class="text-center">
                                        <img class="rounded-circle w-45" src="{{ $customer->avatar_src }}" alt="..." />
                                    </td>
                                    <td class="text-center">
                                            <span class="badge badge-pill badge-{{ $customer->badge_color }}">
                                                {{ $customer->badge_text }}
                                            </span>
                                    </td>
                                    <td>{{ $customer->format_first_name }}</td>
                                    <td>{{ $customer->format_last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->creator_name}}</td>
                                    <td class="text-center">
                                        @if($customer->can_delete)
                                            <button class="btn btn-sm btn-success"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$customer->slug-restore-customer-modal" }}"
                                                    title="Restorer"
                                            >
                                                <i class="mdi mdi-backup-restore"></i>
                                                Restorer
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($customer->can_delete)
                                    @include('partials.restore-confirmation', [
                                        'name' => $customer->full_name,
                                        'modal_id' => "$customer->slug-restore-customer-modal",
                                        'url' => route('archives.customers.restore', compact('customer'))
                                    ])
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $customers->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection