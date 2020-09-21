<div class="breadcrumb-wrapper">
    <h1><i class="{{ $icon }} text-theme"></i> {{ $title }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item"><span class="mdi mdi-home"></span></li>
            @foreach($chain as $item)
                <li class="breadcrumb-item">{{ $item }}</li>
            @endforeach
        </ol>
    </nav>
</div>