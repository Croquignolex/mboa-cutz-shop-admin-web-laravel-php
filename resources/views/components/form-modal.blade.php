@component('components.modal', [
    'modal_id' => $modal_id,
    'modal_size' => 'modal-lg',
    'modal_title' => $modal_title,
])
    <form action="{{ $url }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mx-5">@include('partials.toast-message')</div>
            {{ $slot }}
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light ml-1 mr-1" data-dismiss="modal">
                <i class="mdi mdi-cancel"></i>
                Annuler
            </button>
            <button type="submit" class="btn btn-primary ml-1 mr-1">
                <i class="mdi mdi-check"></i>
                Ajouter
            </button>
        </div>
    </form>
@endcomponent