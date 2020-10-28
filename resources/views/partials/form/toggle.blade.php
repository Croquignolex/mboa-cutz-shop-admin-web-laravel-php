<label class="switch switch-text switch-{{ $color }} switch-pill form-control-label"
       data-toggle="tooltip"
       data-placement="top"
       title="{{ $name }}"
>
    <input id="{{ $id }}"
           type="checkbox"
           name="{{ $id }}"
           {{ $value ? 'checked' : '' }}
           class="switch-input form-check-input"
    >
    <span class="switch-label" data-on="Oui" data-off="Non"></span>
    <span class="switch-handle"></span>
</label>