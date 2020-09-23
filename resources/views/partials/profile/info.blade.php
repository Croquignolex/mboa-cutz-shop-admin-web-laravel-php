<div class="profile-content-left pt-5 pb-3 px-3 px-xl-4">
    <div class="card text-center widget-profile px-0 border-0">
        <div class="card-img mx-auto rounded-circle">
            <img src="{{ auth()->user()->avatar_src }}" alt="..." class="async-image img-responsive">
        </div>
        <div class="my-1">
            <button class="btn btn-sm btn-primary"
                    type="button"
                    onclick="document.getElementById('upload-image-input').click();"
            >
                Modifier
            </button>
            <input type="file"
                   data-ratio="square"
                   data-url="{{ route('profile.update.avatar') }}"
                   hidden
                   id="upload-image-input"
            >
        </div>
        <div class="card-body">
            <h4 class="py-2 text-dark">{{ auth()->user()->full_name }}</h4>
            <p>{{ auth()->user()->email }}</p>
            <span class="badge badge-pill badge-{{ auth()->user()->role->badge_color }} mt-2">
                {{ auth()->user()->role->name }}
            </span>
        </div>
    </div>
    <hr class="w-100">
    <div class="contact-info pt-2">
        <p class="text-dark font-weight-medium pt-4 mb-2">Pénom</p>
        <p>{{ auth()->user()->format_first_name }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Nom</p>
        <p>{{ auth()->user()->format_last_name }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Email</p>
        <p>{{ auth()->user()->email }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Téléphone</p>
        <p>{{ auth()->user()->phone }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Code postal</p>
        <p>{{ auth()->user()->post_code }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Ville</p>
        <p>{{ auth()->user()->city }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Pays</p>
        <p>{{ auth()->user()->country }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Profession</p>
        <p>{{ auth()->user()->profession }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Adresse</p>
        <p>{{ auth()->user()->address }}</p>

        <p class="text-dark font-weight-medium pt-4 mb-2">Description</p>
        <p>{{ auth()->user()->description }}</p>
    </div>
</div>
@include('partials.croup-modal')