@if (isset($email->username) or isset($user->username))
    <div style="width: 27px; height: 27px;"
        class="bg-{{ isset($email->color_by_user) ? $email->color_by_user : $user->color }} d-flex justify-content-center align-items-center rounded-circle"
        data-placement="top" data-toggle="tooltip" data-placement="top"
        title="{{ isset($email->username) ? $email->username : $user->username }}">
        <i class="fa fa-user" style="font-size: 12px"></i>
    </div>
@else
    <div style="width: 27px; height: 27px;"
        class="bg-danger d-flex justify-content-center align-items-center rounded-circle">
        <i class="fa fa-times" style="font-size: 12px"></i>
    </div>
@endif
