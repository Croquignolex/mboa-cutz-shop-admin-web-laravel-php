@extends('layouts.app')

@section('app.master.title', page_title('Tableau de bord'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Tableau de bord',
        'icon' => 'mdi mdi-view-dashboard-outline',
        'chain' => ['Tableau de bord']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{-- Register customer --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="widget-block rounded bg-danger d-flex">
                <div class="widget-info align-self-center w-50">
                    <h3 class="text-white mb-2">
                        <span id="register-customer-value"></span>
                        @include('partials.loader.white-loader', ['id' => 'register-customer-loader'])
                    </h3>
                    <p>Client inscrits</p>
                </div>
                <div class="widget-chart w-50">
                    <canvas id="register-customer-chart" data-url="{{ route('dashboard.register.customer') }}"></canvas>
                </div>
                <button type="button" class="close" id="register-customer-reload"><i class="mdi mdi-reload text-white"></i></button>
            </div>
        </div>
    </div>
@endsection

@push('master.style')
    @if(config('app.env') === 'production')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    @else
        <link rel="stylesheet" href="{{ css_asset('chart.min') }}" type="text/css">
    @endif
@endpush

@push('master.script')
    <script src="{{ js_asset('timezone-detect') }}" type="application/javascript"></script>
    <script src="{{ js_asset('card-dashboard') }}" type="application/javascript"></script>
    @if(config('app.env') === 'production')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    @else
        <script src="{{ js_asset('chart.min') }}" type="application/javascript"></script>
    @endif
@endpush