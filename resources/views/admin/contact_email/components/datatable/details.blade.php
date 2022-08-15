<button data-url="{{ route('contact_email.shipping_details', ['id' => $email->send_id]) }}"
    class="more_details btn btn-primary btn-sm" data-id="{{ $email->send_id }}" type="button">
    <span class="details_mormal">
        <i class="fa fa-file-alt"></i>
    </span>
    <span class="load_item d-none">
        <div class=" spinner-border spinner-border-sm text-white" role="status"></div>
    </span>
</button>
