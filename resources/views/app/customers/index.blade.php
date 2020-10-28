@extends('layouts.app')

@section('app.master.title', page_title('Clients'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Clients ({$customers->total()})",
        'icon' => 'mdi mdi-account-group',
        'chain' => ['Clients']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('customers.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouveau client
                        </a>
                    </div>

                    <div class="mb-3">{{ $customers->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">DATE</th>
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
                                        <td>{{ $customer->creation_date }}</td>
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
                                        <td>{{ $customer->creator_name }}</td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <a href="{{ route('customers.show', compact('customer')) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Détails"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
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