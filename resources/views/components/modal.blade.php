{{-- Start Modal --}}
<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $modal_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $modal_size ?? '' }}" role="document">
        <div class="modal-content">
            {{-- Modal header --}}
            <div class="modal-header">
                <strong class="modal-title">{{ $modal_title }}</strong>
            </div>

            {{ $slot }}
        </div>
    </div>
</div>
{{-- End Modal --}}
