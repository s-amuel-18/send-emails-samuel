@if ($route ?? null)
    <button data-url="{{ $route }}" class="{{ $class }} btn btn-primary btn-sm" data-id="{{ $id }}"
        type="button">
        <span class="details_mormal">
            <i class="fa fa-file-alt"></i>
        </span>
        <span class="load_item d-none">
            <div class=" spinner-border spinner-border-sm text-white" role="status"></div>
        </span>
    </button>
@else
    Sin Detalles
@endif
