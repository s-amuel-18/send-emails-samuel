@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])

@section('content')

    @if ($messageEncome)
        <div class="callout callout-{{ $messageEncome['color'] }}">
            <h5 class="font-weight-bold text-muted">{{ $messageEncome['title'] }}</h5>
            <p>
                {{ $messageEncome['description'] }}

            </p>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-{{ session('message')['color'] }} alert-dismissible fade show" role="alert">
            <i class="{{ session('message')['icon'] }}"></i>
            {{ session('message')['message'] }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    @yield('content_2')

@stop
