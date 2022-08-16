<a href="{{ route('contact_email.shipping_history', ['search' => $email->contact_email]) }}">
    <span style="font-size: 16px"
        class="badge bg-{{ $email->envios_count > 0 ? 'purple' : 'danger' }}">{{ $email->envios_count }}</span>
</a>
