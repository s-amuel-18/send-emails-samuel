<?php

namespace App\Providers;

use App\Models\ContactInfo;
use App\Models\InfoPrimary;
use App\Models\Logo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class FrontProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['front.layouts.app-portfolio', "front.portfolio", "front.project.portfolio-prject"], function ($view) {
            $contact_info = ContactInfo::complete()->whereNotNull("whatsapp_url")->first();
            $logo_img = Logo::published()->first();
            $info_primary = InfoPrimary::published()->first();

            $view->with("info_page", [
                "contact_info" => $contact_info,
                "route_logo" => $logo_img ? "storage/" . $logo_img->url : null,
                "route_avatar" => $info_primary ? "storage/" . $info_primary->url : null,
                "info_primary" => $info_primary,
            ]);
        });
    }
}
