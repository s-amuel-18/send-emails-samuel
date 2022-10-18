@if ($rating)
    @push('css')
        <style>
            .rating-card .rating-start {
                width: 18px;
                display: block;
            }
        </style>
    @endpush


    <div class="rating-card d-flex w-100 mb-2">

        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $rating)
                <img class="rating-start" src="{{ asset('vendor/rating/selectedStar.svg') }}" alt="">
            @else
                <img class="rating-start" src="{{ asset('vendor/rating/unselectedStar.svg') }}" alt="">
            @endif
        @endfor


    </div>
@endif
