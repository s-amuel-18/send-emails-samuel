@if ($email->instagram)
    <a class="btn bg-purple btn-sm" data-toggle="tooltip" data-placement="top" href="{{ $email->instagram }}">
        <i class="fab fa-instagram"></i>
    </a>
@else
    ----
@endif
