@can('contact_email.edit')
    <a href="{{ route('contact_email.edit', ['contact_email' => $id]) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('contact_email.destroy')
    <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este Email')"
        action="{{ route('contact_email.destroy', ['contact_email' => $id]) }}" method="POST">

        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-outline-danger btn-sm">
            <i class="fa fa-trash"></i>
        </button>

    </form>
@endcan
