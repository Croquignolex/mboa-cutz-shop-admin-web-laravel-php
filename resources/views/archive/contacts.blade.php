@extends('layouts.app')

@section('app.master.title', page_title('Messages de contact archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Messages de contact archivés ({$contacts->total()})",
        'icon' => 'mdi mdi-email-open-multiple',
        'chain' => ['Archives', 'Messages de contact archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $contacts->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">NOM & PRENOM</th>
                                <th scope="col">TELEPHONE</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">SUBJECT</th>
                                <th scope="col">MESSAGE</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->creation_date }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td class="text-center">
                                        @if($contact->can_delete)
                                            <button class="btn btn-sm btn-success"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$contact->id-restore-contact-modal" }}"
                                                    title="Restorer"
                                            >
                                                <i class="mdi mdi-backup-restore"></i>
                                                Restorer
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($contact->can_delete)
                                    @include('partials.restore-confirmation', [
                                        'name' => $contact->subject,
                                        'modal_id' => "$contact->id-restore-contact-modal",
                                        'url' => route('archives.contacts.restore', compact('contact'))
                                    ])
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $contacts->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection