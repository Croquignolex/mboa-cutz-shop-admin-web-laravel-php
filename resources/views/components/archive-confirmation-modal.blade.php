@component('components.modal', [
    'modal_id' => $modal_id,
    'modal_title' => "Confirmer l'archivage",
])
    <div class="modal-body bg-danger text-white">
        {{ $slot }}
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light ml-1 mr-1" data-dismiss="modal">
            <i class="mdi mdi-cancel"></i>
            Annuler
        </button>
        <form action="{{ $url }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger ml-1 mr-1">
                <i class="mdi mdi-check"></i>
                Confirmer
            </button>
        </form>
    </div>
@endcomponent