{{--Image--}}
<div class="text-center widget-model px-0 border-0">
    <div class="card-img mx-auto {{ $round_image ? 'rounded-circle' : '' }}">
        <img src="{{ $model->image_src }}" alt="..." class="async-model-image img-responsive">
    </div>
    {{--Edit button--}}
    <div class="my-3">
        <button class="btn btn-primary"
                type="button"
                onclick="document.getElementById('upload-model-image-input').click();"
        >
            <i class="mdi mdi-upload"></i>
            Modifier
        </button>
        <input type="file"
               hidden
               data-url="{{ $url }}"
               data-ratio={{ $croup_ratio }}
               data-class="async-model-image"
               id="upload-model-image-input"
        >
    </div>
</div>
{{--Modal--}}
@include('partials.croup.croup-modal')
