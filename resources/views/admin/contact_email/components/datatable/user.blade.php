@if (isset($email->username) or isset($user->username))
    <div class="d-flex align-items-center">
        <div style="width: {{ $size['width'] ?? '27px' }} ; height: {{ $size['height'] ?? '27px' }};"
            class="{{ $name ?? null and 'mr-2' }} bg-{{ isset($email->color_by_user) ? $email->color_by_user : $user->color }} d-flex justify-content-center align-items-center rounded-circle"
            data-placement="top" data-toggle="tooltip"
            {{ $tooltip ?? false and 'title="' . (isset($email->username) ? $email->username : $user->username) . '"' }}>
            <i class="fa fa-user" style="font-size: 12px"></i>
        </div>

        @if ($name ?? false)
            <span class="d-none d-md-inline">

                {{ isset($email->username) ? $email->username : $user->username }}
            </span>
        @endif
    </div>
@else
    <div style="width: 27px; height: 27px;"
        class="bg-danger d-flex justify-content-center align-items-center rounded-circle">
        <i class="fa fa-times" style="font-size: 12px"></i>
    </div>
@endif
