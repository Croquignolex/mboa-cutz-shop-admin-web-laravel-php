{{-- Start Modal --}}
<div class="modal fade" id="{{ $id_modal }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $id_modal }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $size_modal ?? '' }}" role="document">
        <div class="modal-content">
            {{-- Modal header --}}
            <div class="modal-header">
                <h5 class="modal-title">{{ $title_modal }}</h5>
                <span aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>

            {{-- Modal body --}}
            <div class="modal-body">{{ $slot }}</div>
        </div>
    </div>
</div>
{{-- End Modal --}}
