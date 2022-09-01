{{-- variables del componente: 
    - $value
    - $type
    - $classes
    - $id
    - $placeholder 
    - $url_async_edit 
    - $id_item_element 
    - $method
    - $element_obj_async --}}

@if ($value and $url_async_edit)
    <input style="{{ $style ?? false }}" type="{{ $type ?? 'text' }}"
        class="form-control edit_inline_input {{ $classes ?? '' }}" value="{{ $value }}" id="{{ $id ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}" {{ $url_async_edit ?? false ? 'data-url=' . $url_async_edit : '' }}
        {{ $id_item_element ?? false ? 'data-id=' . $id_item_element : '' }} data-value_init="{{ $value }}"
        {{ $element_obj_async ?? false ? 'data-element_obj=' . $element_obj_async : '' }}>
@else
    -----
@endif
