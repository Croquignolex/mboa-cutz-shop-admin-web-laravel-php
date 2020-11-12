<div class="mb-3">{{ $logs->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
                                    <th scope="col">CREATION</th>
            <th scope="col">TITRE</th>
            <th scope="col">DESCRIPTION</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($logs as $log)
            <tr>
                                        <td style="white-space: nowrap;">{{ $log->creation_date }}</td>
                <td>{{ $log->title }}</td>
                <td>{{ $log->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div>{{ $logs->links() }}</div>