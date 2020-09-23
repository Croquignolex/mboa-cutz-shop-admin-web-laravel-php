<form method="POST" action="{{ route('profile.update.password') }}">
    @csrf
    @include('partials.form.input', [
        'name' => 'Ancien mot de passe',
        'id' => 'old_password',
        'type' => 'password',
        'value' =>  old('old_password'),
    ])
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            @include('partials.form.input', [
               'name' => 'Nouveau mot de passe',
               'id' => 'password',
               'type' => 'password',
               'value' =>  old('password'),
            ])
        </div>
        <div class="col-sm-6 col-xs-12">
            @include('partials.form.input', [
              'name' => 'Confrimer le mot de passe',
              'id' => 'password_confirmation',
              'type' => 'password',
              'value' => old('password_confirmation'),
           ])
        </div>
    </div>
    @include('partials.form.submit')
</form>