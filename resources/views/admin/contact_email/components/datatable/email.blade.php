@if ($email->contact_email)
    <span>{{ $email->contact_email }}</span>
@else
    <b class="text-danger">Sin Email</b>
@endif
