@if ($email->nombre_empresa)
    <span data-placement="top" data-toggle="tooltip" data-placement="top" title="{{ $email->nombre_empresa }}">
        <b>{{ Str::limit($email->nombre_empresa, 15, '...') }}</b>
    </span>
@else
    -----
@endif
