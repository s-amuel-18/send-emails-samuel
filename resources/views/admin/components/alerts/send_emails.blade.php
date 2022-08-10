@can('envio_email.index')
    @push('css')
        <style>
            #cuenta {
                display: flex;
                justify-content: center;
            }

            .simply-section {
                background: #fff;
                width: 90px;
                height: 90px;
                padding: 10px;
                border-radius: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .simply-amount {
                display: block;
                text-align: center !important;
                font-size: 27px;
                font-weight: 700;
            }

            .simply-word {
                font-weight: 300;
                font-size: 17px;
            }
        </style>
    @endpush

    <div class="callout callout-warning {{ $puedo_enviar_emails['puedo_enviar_emails'] ? '' : 'd-none' }}"
        id="select_alert_new_email">
        <h5 class="text-capitalize">¡Ya puedes enviar nuevos emails!</h5>
        <p>Ya transcurrió el tiempo necesario para que puedas enviar nuevos emails, el limite de envios diarios es de
            100
            emails,
            @if ($puedo_enviar_emails['lastEmailSend'])
                <b>Ultimo Correo Enviado {{ $puedo_enviar_emails['lastEmailSend'] }}</b>
            @endif
        </p>

        @if ($puedo_enviar_emails['bodyEmails']->count() > 0)
            <form action="" id="form_send_emails">
                <div class="text-danger mb-3" id="insert_text_error">

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-md-0">
                            <label for="subject">Asunto *</label>
                            <input id="subject" class="form-control form-control-sm" type="text" name="subject"
                                placeholder="Asunto">
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group mb-md-0">
                            <label for="body_email">Cuerpo de mensaje *</label>

                            <select name="body_email" class="select2 form-control form-control-sm" id="body_email"
                                name="body_email">
                                <option value="">-- Seleccionar Cuerpo De Email</option>

                                @foreach ($puedo_enviar_emails['bodyEmails'] as $body)
                                    <option value="{{ $body->id }}">{{ $body->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="">
                            <button class="btn btn-info btn-sm" type="submit">Enviar Emails</button>
                            <a href="{{ route('envio_email.index') }}">
                                <button class="btn btn-light btn-sm" type="button">Enviar Emails</button>
                            </a>

                        </div>
                    </div>
                </div>

            </form>
        @elseif($puedo_enviar_emails['count_emails_register'] > 0)
        @else
            <div class="text-danger">
                <h5 class="h6">No tienes emails registrados <a href="{{ route('contact_email.store') }}">Crea
                        nuevo email</a>
                </h5>
            </div>
        @endif


    </div>
    <div id="content_counter" class="row {{ $puedo_enviar_emails['puedo_enviar_emails'] ? 'd-none' : '' }}">
        <div class="col-md-3 pb-3">
            <h5>Tiempo Restante</h5>
            <div class=" cuenta d-flex" id="cuenta">
            </div>

        </div>
    </div>
@endcan

@push('js')
    <script>
        const dataServer = @json($puedo_enviar_emails);
        const urlHttpSendEmail = @json(route('envio_email.envioEmail'));
    </script>
    <script src="{{ asset('js/functions/emails.js') }}"></script>
    <script src="{{ asset('js/Plugins/simplyCountdown.min.js') }}"></script>
    <script src="{{ asset('js/emails/counter.js') }}"></script>
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    <script src="{{ asset('js/emails/validation.js') }}"></script>
    <script src="{{ asset('js/emails/send.js') }}"></script>

    <script>
        if (!dataServer.puedo_enviar_emails) {
            counter(dataServer["timesLastEmail"]);
        }
    </script>
@endpush
