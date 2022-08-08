@if ($email->username)
    <div style="width: 27px; height: 27px;"
        class="bg-{{ $email->color_by_user }} d-flex justify-content-center align-items-center rounded-circle"
        data-placement="top" data-toggle="tooltip" data-placement="top" title="{{ $email->username }}">
        <i class="fa fa-user" style="font-size: 12px"></i>
    </div>
@else
    <div style="width: 27px; height: 27px;"
        class="bg-danger d-flex justify-content-center align-items-center rounded-circle">
        <i class="fa fa-times" style="font-size: 12px"></i>
    </div>
@endif
