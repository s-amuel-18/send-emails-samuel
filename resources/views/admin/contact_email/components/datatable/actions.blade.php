<a href="{{ route('contact_email.edit', ['contact_email' => $email->contact_id]) }}"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-edit"></i>
</a>

<form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este Email')"
    action="{{ route('contact_email.destroy', ['contact_email' => $email->contact_id]) }}" method="POST">

    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger btn-sm">
        <i class="fa fa-trash"></i>
    </button>
</form>
