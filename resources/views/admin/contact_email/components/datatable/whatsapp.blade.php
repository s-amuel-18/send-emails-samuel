@if ($email->whatsapp)
    <a data-toggle="tooltip" data-placement="top" href="{{ $email->whatsapp }}">{{ Str::limit($email->whatsapp, 30) }}</a>
@else
    -------
@endif
