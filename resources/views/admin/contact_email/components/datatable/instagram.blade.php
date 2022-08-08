@if ($email->instagram)
    <a data-toggle="tooltip" data-placement="top"
        href="{{ $email->instagram }}">{{ Str::limit($email->instagram, 30) }}</a>
@else
    -------
@endif
