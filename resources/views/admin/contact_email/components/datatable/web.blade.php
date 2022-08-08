@if ($email->url)
    <a data-toggle="tooltip" data-placement="top" href="{{ $email->url }}">{{ Str::limit($email->url, 30) }}</a>
@else
    -------
@endif
