@extends('layouts.app')

@section('app.master.title', page_title('Mon profil'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Mon profil',
        'icon' => 'mdi mdi-account',
        'chain' => ['Mon profil']
    ])
@endsection

@section('app.master.body')
    <div class="bg-white border rounded">
        <div class="row no-gutters">
            <div class="col-lg-5 col-xl-4">
                @include('partials.profile.info')
            </div>
            <div class="col-lg-7 col-xl-8">
                <div class="profile-content-right py-4">
                    <div class="mx-5">@include('partials.error-message')</div>
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Mot de passe</a>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="mt-4">
                                @include('partials.profile.edit-info')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <div class="mt-4">
                                @include('partials.profile.edit-password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('app.master.style')
    <link rel="stylesheet" href="{{ css_asset('cropper.min') }}" type="text/css">
@endpush

@push('app.master.script')
    <script src="{{ js_asset('cropper.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('image-crouping') }}" type="application/javascript"></script>
    <script type="application/javascript">
        // Preview image after croup
        function previewImage(base64Image) {
            try
            {
                // Replace all user profile image
                $(".async-image").replaceWith(`<img alt="..." src="${base64Image}" class="img-responsive async-image" />`);
            } catch (ex) { dangerToaster("Une erreur s'est passé dans le script"); console.log(ex) }
        }
    </script>
@endpush
