@extends('layouts.public')

@section('title', $data['title'] ?? 'Mensaje')

@section('content_2')
    <div style="background-color: rgb(245, 245, 245);">
        <div class=" container d-flex justify-content-center align-items-center " style="height: 100vh">
            <div class="w-100">
                <div class="p-4 p-md-5 bg-white col-md-6 offset-md-3 text-center shadow">
                    <i class="text-success display-1 far fa-check-circle" aria-hidden="true"></i>
                    {{-- <i class="fas fa-check-circle-o" aria-hidden="true"></i> --}}
                    <h1 class="font-weight-bold h2 my-3 text-muted">¡Gracias por tu testimonio!</h1>
                    <p class="text-muted">Tu testimonio se ha registrado con existo.</p>

                    <div class="">
                        <a href="{{ route('home') }}" class="btn bg-purple" style="" type="button">Entendido</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@push('js')
    <script>
        const data_server = @json($data['js'] ?? []);
        const rating_testimony = @json($data['testimony']->rating ?? null ? $data['testimony']->rating : 4);
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * clipboard --}}
    <script src="{{ asset('vendor/clipboard/clipboard.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>


    {{-- * funcion para input de rating stars --}}
    <script src="{{ asset('vendor/rating/rating.js') }}"></script>

    {{-- * funcion que nos permite previsualizar una imagen --}}
    <script src="{{ asset('js/functions/preview_image.js') }}"></script>

    {{-- * validacion de formulario --}}
    <script src="{{ asset('js/testimony/validation.js') }}"></script>

    <script>
        $(function() {
            new ClipboardJS("#btn_copy");

            rating.create({
                'selector': '#rating',
                "defaultRating": rating_testimony
            });
        })
    </script>
@endpush
