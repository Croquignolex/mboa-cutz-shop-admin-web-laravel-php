@extends('layouts.app')

@section('app.master.title', page_title('Modifier évènement'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Modifier évènement',
        'icon' => 'mdi mdi-string-lights',
        'chain' => ['Evènement', 'Modifier évènement']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.toast-message')</div>
                    <form action="{{ route('events.update', compact('event')) }}"
                          method="POST"
                          id="date-range-form"
                          data-start="{{ $event->start_date }}"
                          data-end="{{ $event->end_date }}"
                    >
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.date-range', [
                                   'name' => 'Durée*',
                                   'id' => 'range',
                               ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)*',
                                    'id' => 'fr_name',
                                    'type' => 'text',
                                    'value' => old('fr_name') ?? $event->fr_name
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)*',
                                    'id' => 'en_name',
                                    'type' => 'text',
                                    'value' => old('en_name') ?? $event->en_name
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Lieux (français)*',
                                    'id' => 'fr_localisation',
                                    'type' => 'text',
                                    'value' => old('fr_localisation') ?? $event->fr_localisation
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Lieux (anglais)*',
                                    'id' => 'en_localisation',
                                    'type' => 'text',
                                    'value' => old('en_localisation') ?? $event->en_localisation
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (français)',
                                    'id' => 'fr_description',
                                    'value' => old('fr_description') ?? $event->fr_description
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (anglais)',
                                    'id' => 'en_description',
                                    'value' => old('en_description') ?? $event->en_description
                                ])
                            </div>
                            <div class="col-sm-12">
                                @include('partials.form.textarea', [
                                    'name' => 'Lien de la map Google',
                                    'id' => 'map',
                                    'value' => old('map') ?? $event->map
                                ])
                            </div>
                        </div>
                        @include('partials.form.submit')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('app.master.style')
    <link rel="stylesheet" href="{{ css_asset('daterangepicker') }}" type="text/css">
@endpush

@push('app.master.script')
    <script src="{{ js_asset('moment.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('daterangepicker') }}" type="application/javascript"></script>
    <script>
        const startDate = $("#date-range-form").data('start');
        const startEnd = $("#date-range-form").data('end');

        $('#range').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            startDate: moment(startDate, 'DD MMM, YYYY à H:mm'),
            endDate: moment(startEnd, 'DD MMM, YYYY à H:mm'),
            locale: {format: 'DD MMM, YYYY à H:mm'}
        });
    </script>
@endpush
