@if (isset($email->url) or isset($url))
    <a target="_blanck" class="btn bg-info btn-sm" data-toggle="tooltip" data-placement="top"
        href="{{ isset($email->url) ? $email->url : $url }}">
        <i class="fas fa-external-link-alt"></i>
    </a>
@else
    -----
@endif
