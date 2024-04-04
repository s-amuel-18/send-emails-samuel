@if ($email->contact_email)
    <a href="{{ route('contact_email.index', ['search' => $email->contact_email]) }}">
        {{ $email->contact_email }}
    </a>
@else
    <b class="text-danger">Sin Email</b>
@endif
