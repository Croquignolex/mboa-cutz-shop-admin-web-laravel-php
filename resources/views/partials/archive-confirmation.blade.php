@component('components.archive-confirmation-modal', [
    'modal_id' => $modal_id,
    'url' => $url
])
    <p>
        Voulez-vous archiver <strong>{{ $name }}</strong>?<br><br>
        Vous pouvez toujours le consulter dans la section des archives
        et le restaurer à tous moment.
    </p>
@endcomponent