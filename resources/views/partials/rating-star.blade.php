@if($rate % 2 === 0)
    @for($i = 0; $i < $rate; $i += 2)
        <i class="mdi mdi-star"></i>
    @endfor
    @for($i = 0; $i < 10 - $rate; $i += 2)
        <i class="mdi mdi-star-outline"></i>
    @endfor
@else
    @for($i = 0; $i < $rate - 1; $i += 2)
        <i class="mdi mdi-star"></i>
    @endfor
    <i class="mdi mdi-star-half"></i>
    @for($i = 0; $i < 10 - $rate - 1; $i += 2)
        <i class="mdi mdi-star-outline"></i>
    @endfor
@endif
