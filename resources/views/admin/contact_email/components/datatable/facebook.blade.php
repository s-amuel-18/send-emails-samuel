@if ($email->facebook)
    <a data-toggle="tooltip" data-placement="top" href="{{ $email->facebook }}">{{ Str::limit($email->facebook, 30) }}</a>
@else
    -------
@endif
