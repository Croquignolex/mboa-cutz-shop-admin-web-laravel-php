{{-- Start Modal --}}
<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $modal_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $modal_size ?? '' }}" role="document">
        <div class="modal-content">
            {{-- Modal header --}}
            <div class="modal-header">
                <strong class="modal-title">{{ $modal_title }}</strong>
                <span aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>

            {{ $slot }}
        </div>
    </div>
</div>
{{-- End Modal --}}
