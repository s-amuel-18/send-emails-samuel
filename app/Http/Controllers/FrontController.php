<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\Project;
use App\Models\SocialMedia;
use App\Models\Testimony;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $count_testimonies = 7;

        $data["projects"] = Project::notNull()
            ->orderBy("created_at", "DESC")
            ->take(10)
            ->getWithImagesExist()
            ->take(6);
        $data["testimonies"] = Testimony::published()->orderBy("created_at", "DESC")->with("image")->take($count_testimonies)->get();
        $data["contact_info"] = ContactInfo::complete()->whereNotNull("whatsapp_url")->first();

        $image_user_default = asset('assets-portfolio/img/icons-proming/profile.png');

        $images_testimonies = $data["testimonies"]->map(function ($testimony) use ($image_user_default) {
            return $testimony->image
                ? asset("storage/" . $testimony->image->url)
                : $image_user_default;
        });

        $data["images_testimonies"] = $images_testimonies;

        $data["social_media"] = SocialMedia::complete()->get();

        $data['js'] = [
            "url_post_contact_message" => route("envio_email.client_contact_front")
        ];
        return view("front.portfolio", compact("data"));
    }
}
