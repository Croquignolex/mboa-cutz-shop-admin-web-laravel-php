@component('components.modal', [
    'modal_id' => 'upload-modal',
    'modal_title' => 'Modifier la photo de profil',
])
    <div class="modal-body">
        <div class="mb-2" id="croup-modal-image-canvas">
            <img id="croup-modal-image" class="overflow-auto mw-100 img-responsive" src="#" alt="..."/>
        </div>
    </div>

    <div class="modal-footer">
        <div id="croup-modal-action-buttons">
            <button type="button" class="btn btn-light ml-1 mr-1" data-dismiss="modal">
                <i class="mdi mdi-cancel"></i>
                Annuler
            </button>
            <button type="button" class="btn btn-primary ml-1 mr-1" id="modal-save-image">
                <i class="mdi mdi-check"></i>
                Enrégistrer
            </button>
        </div>
        @include('partials.loader.bloc-loader', ['id' => 'croup-modal-loader'])
    </div>
@endcomponent