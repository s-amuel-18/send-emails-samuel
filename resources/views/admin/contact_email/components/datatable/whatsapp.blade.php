@if ($email->whatsapp)
    <a class="btn bg-success btn-sm" data-toggle="tooltip" data-placement="top" href="{{ $email->whatsapp }}">
        <i class="fab fa-whatsapp"></i>
    </a>
@else
    ----
@endif
