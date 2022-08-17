@if ($name)
    <span data-placement="top" data-toggle="tooltip" data-placement="top" title="{{ $name }}">
        <b>{{ Str::limit($name, $limit_name ?? false ? $limit_name : 100, '...') }}</b>
    </span>
@else
    -----
@endif
