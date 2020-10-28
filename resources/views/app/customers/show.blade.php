@extends('layouts.app')

@section('app.master.title', page_title('Détails client'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails client',
        'icon' => 'mdi mdi-account-group',
        'chain' => ['Clients', 'Détails client']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('customers.update', compact('customer')) }}" method="POST" id="status-toggle-form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    @if($customer->can_delete)
                                        <button class="btn btn-danger"
                                                data-toggle="modal"
                                                type="button"
                                                data-target="{{ "#archive-customer-modal" }}"
                                        >
                                            <i class="mdi mdi-archive"></i>
                                            Archiver
                                        </button>
                                    @endif
                                </div>
                                <div class="col text-right">
                                    @include('partials.form.toggle', [
                                        'name' => $customer->badge_text,
                                        'id' => 'status-toggle',
                                        'color' => 'success',
                                        'value' => $customer->is_confirmed
                                    ])
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('partials.user.user-info', ['user' => $customer, 'can_update_avatar' => false])
                </div>
            </div>
        </div>
        {{--Logs--}}
        <div class="col-lg-7 col-xl-8">
            <div class="card card-default">
                <div class="card-body">
                    <h5>Commandes (0)</h5>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($customer->can_delete)
        @include('partials.archive.archive-confirmation', [
             'name' => $customer->full_name,
             'modal_id' => "archive-customer-modal",
             'url' => route('customers.destroy', compact('customer'))
        ])
    @endif
@endsection

@push('app.master.script')
    <script type="application/javascript">
        $(document).ready(function() {
            $('#status-toggle').click(function() {
                $('#status-toggle-form').submit()
            });
        });
    </script>
@endpush