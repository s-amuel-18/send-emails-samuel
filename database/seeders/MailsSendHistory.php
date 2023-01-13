<?php

namespace Database\Seeders;

use App\Models\Contact_email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailsSendHistory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_envios = [
            ["group" => 1, "date" => Carbon::yesterday()],
            ["group" => 2, "date" => Carbon::today()]
        ];
        $arr_envios = collect($arr_envios);
        $arr_envios->each(function ($envio) {
            $group_send = $envio["group"];
            $created_at = $envio["date"];

            for ($i = 0; $i < 3; $i++) {
                $contactEmail = Contact_email::whereHas("envios", null, "=", 0)->get()->random();
                $contactEmail->update(["estado" => 1]);
                DB::table('contact_email_user')->insert([
                    "user_id" => User::all()->random()->id,
                    "contact_email_id" => $contactEmail->id,
                    "group_send" => $group_send,
                    "subject" => "Este es mi asunto",
                    "body" => "Esta es mi descripción",
                    "type" => 0,
                    "created_at" => $created_at,
                ]);
            }
        });
    }
}
