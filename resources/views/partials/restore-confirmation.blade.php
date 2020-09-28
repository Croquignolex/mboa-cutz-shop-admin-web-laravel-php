@component('components.restore-confirmation-modal', [
    'modal_id' => $modal_id,
        'url' => $url
    ])
    <p>
        Voulez-vous restorer <strong>{{ $name }}</strong>?<br><br>
        Une fois restoré, vous pourrez effectuer toutes opératons possible.
    </p>
@endcomponent