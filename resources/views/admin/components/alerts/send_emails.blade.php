@can('envio_email.index')
    @if ($puedo_enviar_emails)
        <div class="callout callout-warning">
            <h5 class="text-capitalize">¡Ya puedes enviar nuevos emails!</h5>
            <p>Ya transcurrió el tiempo necesario para que puedas enviar nuevos emails, el limite de envios diarios es de
                100
                emails.</p>
            <div class="">
                <button class="btn btn-info btn-sm" type="button">Enviar Emails</button>
                <a href="{{ route('envio_email.index') }}">
                    <button class="btn btn-light btn-sm" type="button">Enviar Emails</button>
                </a>
            </div>
        </div>
    @endif
@endcan

@push('js')
@endpush
