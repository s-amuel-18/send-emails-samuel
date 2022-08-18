@if ($route ?? null)
    <button data-url="{{ $route }}" class="{{ $class }} btn btn-outline-primary btn-sm"
        data-id="{{ $id }}" type="button">
        <span class="normal_item">
            <i class="fa fa-file-alt"></i>
        </span>
        <span class="load_item d-none">
            <div style="width: .9rem; height: .9rem;" class=" spinner-border spinner-border-sm text-white" role="status">
            </div>
        </span>
    </button>
@else
    Sin Detalles
@endif
