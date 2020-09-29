<form method="POST" action={{ route('profile.update.info') }}>
    @csrf
    <div class="row">
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Prénom',
                'id' => 'first_name',
                'type' => 'text',
                'value' =>  old('first_name') ?? auth()->user()->first_name,
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Nom',
                'id' => 'last_name',
                'type' => 'text',
                'value' =>  old('last_name') ?? auth()->user()->last_name,
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
               'name' => 'Téléphone',
               'id' => 'phone',
               'type' => 'text',
               'value' =>  old('phone') ?? auth()->user()->phone,
           ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Code postal',
                'id' => 'post_code',
                'type' => 'text',
                'value' =>  old('post_code') ?? auth()->user()->post_code,
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Ville',
                'id' => 'city',
                'type' => 'text',
                'value' =>  old('city') ?? auth()->user()->city,
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Pays',
                'id' => 'country',
                'type' => 'text',
                'value' =>  old('country') ?? auth()->user()->country,
            ])
        </div>
        <div class="col-sm-6">
            @include('partials.form.input', [
                'name' => 'Profession',
                'id' => 'profession',
                'type' => 'text',
                'value' =>  old('profession') ?? auth()->user()->profession,
            ])
        </div>
        <div class="col-sm-6 col-xs-12">
            @include('partials.form.input', [
               'name' => 'Adresse',
               'id' => 'address',
               'type' => 'text',
               'value' =>  old('address') ?? auth()->user()->address,
           ])
        </div>
        <div class="col-sm-12">
            @include('partials.form.textarea', [
                'name' => 'Description',
                'id' => 'description',
                'value' => old('description') ?? auth()->user()->description,
            ])
        </div>
    </div>
    @include('partials.form.submit')
</form>