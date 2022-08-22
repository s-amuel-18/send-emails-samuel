@if ($email->instagram)
    <a class="{{ $class ?? false }} btn bg-purple btn-sm btn-notification" data-toggle="tooltip" data-placement="top"
        href="{{ $email->instagram }}" {{ $id ?? false ? 'data-id=' . $id : '' }}
        {{ $id ?? false ? 'data-url=' . $url : '' }}
        {{ $type_contact ?? false ? 'data-type_contact_alternative=' . $type_contact : '' }}>
        @if (isset($count_shipping))
            <span class="{{ $count_shipping <= 0 ? 'd-none' : '' }} badge badge-pill bg-danger"
                style="font-size: 13px">{{ $count_shipping }}</span>
        @endif

        <i class="fab fa-instagram"></i>
    </a>
@else
    ----
@endif
