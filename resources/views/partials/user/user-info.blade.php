<div class="card text-center widget-profile px-0 border-0">
    <div class="card-img mx-auto rounded-circle">
        <img src="{{ $user->avatar_src }}" alt="..." class="async-image img-responsive">
    </div>
    @if($can_update_avatar)
        <div class="my-1">
            <button class="btn btn-sm btn-primary"
                    type="button"
                    onclick="document.getElementById('upload-image-input').click();"
            >
                <i class="mdi mdi-upload"></i>
                Modifier
            </button>
            <input type="file"
                   data-ratio="square"
                   data-url="{{ route('profile.update.avatar') }}"
                   data-class="async-image"
                   hidden
                   id="upload-image-input"
            >
        </div>
    @endif
    <div class="card-body">
        <h4 class="py-2 text-dark">{{ $user->full_name }}</h4>
        <p>{{ $user->email }}</p>
        <span class="badge badge-pill badge-{{ $user->role->badge_color }} mt-2">
            {{ $user->role->name }}
        </span>
    </div>
</div>
<hr class="w-100">
<div class="contact-info pt-2">
    <p class="text-dark font-weight-medium pt-4 mb-2">Téléphone</p>
    <p>{{ $user->phone }}</p>

    <p class="text-dark font-weight-medium pt-4 mb-2">Code postal</p>
    <p>{{ $user->post_code }}</p>

    <p class="text-dark font-weight-medium pt-4 mb-2">Ville</p>
    <p>{{ $user->city }}</p>

    <p class="text-dark font-weight-medium pt-4 mb-2">Pays</p>
    <p>{{ $user->country }}</p>

    <p class="text-dark font-weight-medium pt-4 mb-2">Profession</p>
    <p>{{ $user->profession }}</p>

    <p class="text-dark font-weight-medium pt-4 mb-2">Adresse</p>
    <p>{{ $user->address }}</p>

    <p class="text-dark font-weight-medium pt-4 mb-2">Description</p>
    <p>{{ $user->description }}</p>
</div>

@if($can_update_avatar)
    @include('partials.croup.croup-modal')
@endif