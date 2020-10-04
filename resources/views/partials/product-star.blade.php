@if($ranking % 2 === 0)
    @for($i = 0; $i < $ranking; $i += 2)
        <i class="mdi mdi-star"></i>
    @endfor
    @for($i = 0; $i < 10 - $ranking; $i += 2)
        <i class="mdi mdi-star-outline"></i>
    @endfor
@else
    @for($i = 0; $i < $ranking - 1; $i += 2)
        <i class="mdi mdi-star"></i>
    @endfor
    <i class="mdi mdi-star-half"></i>
    @for($i = 0; $i < 10 - $ranking - 1; $i += 2)
        <i class="mdi mdi-star-outline"></i>
    @endfor
@endif
