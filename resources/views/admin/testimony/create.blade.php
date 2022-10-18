@extends('layouts.app')

@section('title', $data['title'] ?? 'Testimonio')




@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/rating/rating.css') }}">
@endpush

@section('content_2')

    <div class="container pt-4">
        <div class="row">

            <div class="col-md-8 {{ !auth()->user() ? 'offset-md-2' : '' }}">
                <div class="card card-light shadow ">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data['title'] ?? 'Testimonio' }}</h3>
                    </div>

                    <div class="card card-body">

                        <form action="">
                            <div class="row">

                                {{-- * Nombre --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_testimony">Nombre y apellido</label>
                                        <input id="name_testimony" placeholder="Nombre y apellido" class="form-control"
                                            type="text" name="name">
                                    </div>
                                </div>

                                {{-- * Puesto de trabajo --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_testimony">Puesto de trabajo</label>
                                        <input id="position_testimony" placeholder="CEO de xxx xxxxx" class="form-control"
                                            type="text" name="position">
                                    </div>
                                </div>

                                {{-- * clasificación --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title_testimony">Puntuación</label>
                                        <div id="rating"></div>
                                    </div>
                                </div>

                                {{-- * Titulo --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title_testimony">Titulo</label>
                                        <input id="title_testimony" placeholder="Buen trabajador" class="form-control"
                                            type="text" name="title">
                                    </div>
                                </div>

                                {{-- * Descriptcion --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="review_testimony">Reseña</label>
                                        <textarea class="form-control" name="review" id="review_testimony" rows="5"
                                            placeholder="Buen trabajador y excelente persona…"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn bg-purple" type="button">Crear testimonio</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            @if (auth()->user())
                <div class="col-md-4">
                    <div class="card card-light shadow ">
                        <div class="card-header">
                            <h3 class="card-title">Solicitar testimonio</h3>
                        </div>

                        <div class="card card-body">
                            <div class="">
                                <h5>Solicitar testimonio</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem dolore ex eius
                                    laboriosam
                                    maxime, molestiae sunt soluta sint maiores veritatis ipsum pariatur numquam ipsam
                                    assumenda
                                    sequi obcaecati illo exercitationem aliquid!</p>

                                <div class="d-flex">
                                    <input id="copy_url_tetimony" class="form-control flex-basis" type="text" readonly
                                        value="{{ route('adminlte.darkmode.toggle') }}">

                                    <button id="btn_copy" class="btn btn-success" type="button"
                                        data-clipboard-target="#copy_url_tetimony">
                                        <i class="fa fa-copy"></i>
                                    </button>


                                </div>

                                <form action="" class="mt-4">
                                    <h5 class="mb-3">Enviar solicitud de testimonio</h5>

                                    <div class="form-group">
                                        <label for="email_request_testimony">Correo electronico</label>
                                        <input id="email_request_testimony" class="form-control" type="email"
                                            name="email" placeholder="Correo electronico Destinatario">
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn bg-purple" type="submit">Enviar solicitud</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@stop


@push('js')
    <script>
        const data_server = @json($data['js'] ?? []);
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * clipboard --}}
    <script src="{{ asset('vendor/clipboard/clipboard.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>


    {{-- * funcion para input de rating stars --}}
    <script src="{{ asset('vendor/rating/rating.js') }}"></script>


    <script>
        $(function() {
            new ClipboardJS("#btn_copy");

            rating.create({
                'selector': '#rating',
                "defaultRating": 4
            });
        })
    </script>
@endpush
