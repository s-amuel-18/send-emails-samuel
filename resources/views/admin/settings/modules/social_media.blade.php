<div class="mb-3">
    <form id="form_create_social_media" action="{{ route('settings.create_social_media_async') }}"
        data-action_default="{{ route('settings.create_social_media_async') }}">

        <input type="hidden" name="id_social_media" value="0">

        <div class="row no-guetters ">
            <div class="col-12 col-lg-2">
                <span class="input-group-append">
                    <button id="select_icon_iconpicker" class="w-100 btn-sm btn bg-purple" data-search="true"
                        data-search-text="Buscar icono" data-iconset="fontawesome5" data-rows="4" data-cols="6"
                        data-icon="fab fa-facebook" role="iconpicker"></button>
                    <input type="hidden" id="input_select_icon" name="icon" value="fab fa-facebook">
                </span>
            </div>

            <div class="py-3 py-lg-0 col-12 col-lg-6 col-xl-8">
                <input class="form-control form-control-sm w-100" type="text" name="url"
                    placeholder="Url de la red social o contacto">
            </div>

            <div class="col-12 col-lg-2 col-xl-1">
                <button class="w-100 btn btn-sm btn-outline-primary" type="submit" id="create_social_media">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="" id="insert_items_social_media">

    @foreach ($data['social_medias'] as $social)
        <div class="mb-3 row no-guetters" data-id="{{ $social->id }}" id="social_media_{{ $social->id }}">
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="{{ $social->url }}" target="_blanck" class="btn-sm btn btn-secondary w-100">
                    <i class="{{ $social->icon }} icon_social"></i>
                </a>
            </div>

            <div class="d-flex align-items-center col-2 col-sm-3 col-lg-6 col-xl-8" style="overflow: hidden">
                <p class="mb-0 url_social" style="white-space: nowrap">{{ $social->url }}</p>
            </div>

            <div class="col-3 col-lg-2 col-xl-1">
                <button class="update_social_media w-100 btn-sm btn btn-outline-success" type="button"
                    data-url="{{ $social->routeGetSocialMedia }}">
                    <i class="fa fa-edit"></i>
                </button>
            </div>
            <div class="col-3 col-lg-2 col-xl-1">
                <button class="delete_social_media w-100 btn-sm btn btn-outline-danger" type="button"
                    data-url="{{ $social->routeDelete }}">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    @endforeach

</div>
