<form method="POST" action="{{ route('profile.update.password') }}">
    @csrf
    @include('partials.form.input', [
        'name' => 'Ancien mot de passe',
        'id' => 'old_password',
        'icon' => 'mdi mdi-textbox-password',
        'type' => 'password',
        'value' =>  old('old_password'),
    ])
    @include('partials.form.input', [
       'name' => 'Nouveau mot de passe',
       'id' => 'password',
       'icon' => 'mdi mdi-textbox',
       'type' => 'password',
       'value' =>  old('password'),
    ])
    @include('partials.form.input', [
      'name' => 'Confrimer le mot de passe',
      'id' => 'password_confirmation',
      'icon' => 'mdi mdi-textbox',
      'type' => 'password',
      'value' => old('password_confirmation'),
   ])
    @include('partials.form.submit')
</form>