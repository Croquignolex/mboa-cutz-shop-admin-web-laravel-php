@component('components.modal', [
    'modal_id' => $modal_id,
    'modal_title' => "Confirmer la restoration",
])
    <div class="modal-body bg-success text-white">
        {{ $slot }}
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light ml-1 mr-1" data-dismiss="modal">
            <i class="mdi mdi-cancel"></i>
            Annuler
        </button>
        <form action="{{ $url }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success ml-1 mr-1">
                <i class="mdi mdi-check"></i>
                Confirmer
            </button>
        </form>
    </div>
@endcomponent