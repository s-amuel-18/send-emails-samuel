@if ($email->url)
    <a class="btn bg-info btn-sm" data-toggle="tooltip" data-placement="top" href="{{ $email->url }}">
        <i class="fas fa-external-link-alt"></i>
    </a>
@else
    -------
@endif
