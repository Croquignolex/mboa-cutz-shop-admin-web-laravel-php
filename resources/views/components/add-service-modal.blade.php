@component('components.form-modal', [
   'modal_id' => "add-service-modal",
   'modal_title' => "Ajouter un service",
   'url' => $url,
])
    <div class="row mb-2">
        <div class="col">
            @include('partials.form.toggle', [
                'name' => 'En vedette',
                'id' => 'featured',
                'color' => 'info',
                'value' => old('featured')
            ])
            @include('partials.form.toggle', [
                'name' => 'Mailleur réservation',
                'id' => 'most_asked',
                'color' => 'primary',
                'value' => old('most_asked')
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Nom (français)*',
                'id' => 'fr_name',
                'type' => 'text',
                'value' => old('fr_name')
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Nom (anglais)*',
                'id' => 'en_name',
                'type' => 'text',
                'value' => old('en_name')
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            @include('partials.form.input', [
                'name' => 'Prix*',
                'id' => 'price',
                'type' => 'number',
                'value' => old('price') ?? 0
            ])
        </div>
        <div class="col-sm-4">
            @include('partials.form.input', [
                'name' => 'Reduction (%)*',
                'id' => 'discount',
                'type' => 'number',
                'value' => old('discount') ?? 0
            ])
        </div>
        <div class="col-sm-4">
            {{ $slot }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @include('partials.form.textarea', [
                'name' => 'Description (français)',
                'id' => 'fr_description',
                'value' => old('fr_description')
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.textarea', [
                'name' => 'Description (anglais)',
                'id' => 'en_description',
                'value' => old('en_description')
            ])
        </div>
    </div>
@endcomponent