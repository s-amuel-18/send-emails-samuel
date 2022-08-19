<button {{ $dataid ?? false ? 'data-id=' . $dataid : '' }} type="{{ $type ?? null ? $type : 'button' }}"
    class="btn btn-outline-danger btn-{{ $size }} {{ $class ?? null ? $class : '' }}" id="{{ $id ?? null }}"
    style="{{ $style }}">
    <span class="normal_item">
        <i class="fa fa-trash"></i>
    </span>
    <span class="load_item d-none">
        <div style="width: .9rem; height: .9rem;" class=" spinner-border spinner-border-sm text-danger" role="status">
        </div>
    </span>
</button>
