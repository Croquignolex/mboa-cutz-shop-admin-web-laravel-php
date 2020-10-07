@extends('layouts.app')

@section('app.master.title', page_title('Modifier administrateur'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Modifier administrateur',
        'icon' => 'mdi mdi-account-multiple',
        'chain' => ['Administrateurs', 'Modifier administrateur']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.error-message')</div>
                    <form action="{{ route('admins.update', compact('admin')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-4">
                                @include('partials.form.select', [
                                    'name' => 'Role*',
                                    'id' => 'role',
                                    'title' => 'Choisir un role',
                                    'value' => old('role') ?? $role,
                                    'options' => $roles,
                                    'multi' => false
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Prénom*',
                                    'id' => 'first_name',
                                    'type' => 'text',
                                    'value' => old('first_name') ?? $admin->first_name,
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Nom*',
                                    'id' => 'last_name',
                                    'type' => 'text',
                                    'value' => old('last_name') ?? $admin->last_name,
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Profession',
                                    'id' => 'profession',
                                    'type' => 'text',
                                    'value' =>  old('profession') ?? $admin->profession,
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                   'name' => 'Téléphone',
                                   'id' => 'phone',
                                   'type' => 'text',
                                   'value' =>  old('phone') ?? $admin->phone,
                               ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                   'name' => 'Adresse',
                                   'id' => 'address',
                                   'type' => 'text',
                                   'value' =>  old('address') ?? $admin->address,
                               ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Code postal',
                                    'id' => 'post_code',
                                    'type' => 'text',
                                    'value' =>  old('post_code') ?? $admin->post_code,
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Ville',
                                    'id' => 'city',
                                    'type' => 'text',
                                    'value' =>  old('city') ?? $admin->city,
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Pays',
                                    'id' => 'country',
                                    'type' => 'text',
                                    'value' =>  old('country') ?? $admin->country,
                                ])
                            </div>
                            <div class="col-sm-8">
                                @include('partials.form.textarea', [
                                   'name' => 'Description',
                                   'id' => 'description',
                                   'value' => old('description') ?? $admin->description,
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

@include('partials.select-scripts')
