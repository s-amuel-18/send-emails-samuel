<button type="{{ $type ?? null ? $type : 'submit' }}"
    class="btn btn-outline-success btn-sm {{ $class ?? null ? $class : '' }}" {{ $id ?? false ? 'id=' . $id : '' }}>
    <span class="normal_item">
        <i class="fa fa-edit"></i>
    </span>
    <span class="load_item d-none">
        <div style="width: .9rem; height: .9rem;" class=" spinner-border spinner-border-sm text-success" role="status">
        </div>
    </span>
</button>
