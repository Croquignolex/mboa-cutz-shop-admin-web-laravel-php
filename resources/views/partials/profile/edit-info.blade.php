<form method="POST" action={{ route('profile.update.info') }}>
    @csrf
    @include('partials.form.input', [
        'name' => 'Prénom',
        'id' => 'first_name',
        'icon' => 'mdi mdi-account-question',
        'type' => 'text',
        'value' =>  old('first_name') ?? auth()->user()->first_name,
    ])
    @include('partials.form.input', [
        'name' => 'Nom',
        'id' => 'last_name',
        'icon' => 'mdi mdi-account-question-outline',
        'type' => 'text',
        'value' =>  old('last_name') ?? auth()->user()->last_name,
    ])
    @include('partials.form.input', [
        'name' => 'Téléphone',
        'id' => 'phone',
        'icon' => 'mdi mdi-deskphone',
        'type' => 'text',
        'value' =>  old('phone') ?? auth()->user()->phone,
    ])
    @include('partials.form.input', [
        'name' => 'Code postal',
        'id' => 'post_code',
        'icon' => 'mdi mdi-inbox',
        'type' => 'text',
        'value' =>  old('post_code') ?? auth()->user()->post_code,
    ])
    @include('partials.form.input', [
        'name' => 'Ville',
        'id' => 'city',
        'icon' => 'mdi mdi-city-variant-outline',
        'type' => 'text',
        'value' =>  old('city') ?? auth()->user()->city,
    ])
    @include('partials.form.input', [
        'name' => 'Pays',
        'id' => 'country',
        'icon' => 'mdi mdi-flag',
        'type' => 'text',
        'value' =>  old('country') ?? auth()->user()->country,
    ])
    @include('partials.form.input', [
        'name' => 'Profession',
        'id' => 'profession',
        'icon' => 'mdi mdi-worker',
        'type' => 'text',
        'value' =>  old('profession') ?? auth()->user()->profession,
    ])
    @include('partials.form.input', [
       'name' => 'Adresse',
       'id' => 'address',
       'icon' => 'mdi mdi-home-account',
       'type' => 'text',
       'value' =>  old('address') ?? auth()->user()->address,
   ])
    @include('partials.form.textarea', [
       'name' => 'Description',
       'id' => 'description',
       'icon' => 'mdi mdi-format-align-justify',
       'value' => old('description') ?? auth()->user()->description,
   ])
    @include('partials.form.submit')
</form>