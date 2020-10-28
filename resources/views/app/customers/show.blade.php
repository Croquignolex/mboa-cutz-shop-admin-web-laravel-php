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
                            @include('partials.form.toggle', [
                                'name' => $customer->badge_text,
                                'id' => 'confirm',
                                'color' => 'success',
                                'value' => $customer->is_confirmed
                           ])
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
@endsection

@push('app.master.script')
    <script type="application/javascript">
        $(document).ready(function() {
            $('#confirm').click(function() {
                $('#status-toggle-form').submit()
            });
        });
    </script>
@endpush