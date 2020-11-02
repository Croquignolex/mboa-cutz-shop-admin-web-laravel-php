@component('components.form-modal', [
   'modal_id' => "add-article-modal",
   'modal_title' => "Ajouter un article",
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
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            {{ $slot }}
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