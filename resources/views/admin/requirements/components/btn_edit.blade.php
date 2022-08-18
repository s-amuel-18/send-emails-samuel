@if ($id ?? null)
    <button data-url_edit="{{ route('requirements.update', ['id' => $id]) }}"
        data-url="{{ route('requirements.get_requirement', ['id' => $id]) }}" onclick="edit_requirement(this)"
        type="{{ $type ?? null ? $type : 'submit' }}"
        class="btn btn-outline-success btn-sm {{ $class ?? null ? $class : '' }}" {{ $id ? 'data-id=' . $id : '' }}>
        <span class="normal_item">
            <i class="fa fa-edit"></i>
        </span>
        <span class="load_item d-none">
            <div style="width: .9rem; height: .9rem;" class=" spinner-border spinner-border-sm text-success"
                role="status">
            </div>
        </span>
    </button>
@endif
