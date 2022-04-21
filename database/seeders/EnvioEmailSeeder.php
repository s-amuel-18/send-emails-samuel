<?php

namespace Database\Seeders;

use App\Models\Contact_email;
use App\Models\EmailEnviado;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class EnvioEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $emails = Contact_email::whereNotNull("email")->where("estado", "=", 1)->get();

        $date = Carbon::now();
        $date = $date->format('Y-m-d');


        foreach ($emails  as $email) {
            $user_admin = Role::where("name", "=", "Administrador")->get()[0]->users->random();

            $enviados_hoy = EmailEnviado::whereDate("created_at", $date)->count();

            if( $enviados_hoy < 200 ){
                $user_admin->emailEnviado()->create([
                    "contact_email_id" => $email->id
                ]);

            }

        }

    }
}
