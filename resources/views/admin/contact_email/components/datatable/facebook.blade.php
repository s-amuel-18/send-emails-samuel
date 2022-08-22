@if ($email->facebook)
    <a class="{{ $class ?? false }} btn btn-primary btn-sm btn-notification" href="{{ $email->facebook }}"
        {{ $id ?? false ? 'data-id=' . $id : '' }} {{ $id ?? false ? 'data-url=' . $url : '' }}
        {{ $type_contact ?? false ? 'data-type_contact_alternative=' . $type_contact : '' }}>

        @if (isset($count_shipping))
            <span class="{{ $count_shipping <= 0 ? 'd-none' : '' }} badge badge-pill bg-danger"
                style="font-size: 13px">{{ $count_shipping }}</span>
        @endif

        <i class="fab fa-facebook"></i>
    </a>
@else
    ----
@endif
