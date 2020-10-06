<label class="switch switch-text switch-{{ $color }} switch-pill form-control-label"
       data-toggle="tooltip"
       data-placement="top"
       title="{{ $name }}"
>
    <input type="checkbox"
           class="switch-input form-check-input"
           name="{{ $id }}"
           {{ $value ? 'checked' : '' }}
    >
    <span class="switch-label" data-on="Oui" data-off="Non"></span>
    <span class="switch-handle"></span>
</label>