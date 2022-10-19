<?php

namespace App\Observers;

use App\Models\Testimony;

class TestimonyObserver
{
    /**
     * Handle the Testimony "created" event.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return void
     */
    public function created(Testimony $testimony)
    {
        do {
            $uuid = rand(11111111, 99999999);

            $uuid_exist = Testimony::where("uuid", $uuid)->count();
        } while ($uuid_exist >= 1);

        $testimony->uuid = $uuid;
        $testimony->save();
    }

    /**
     * Handle the Testimony "updated" event.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return void
     */
    public function updated(Testimony $testimony)
    {
        //
    }

    /**
     * Handle the Testimony "deleted" event.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return void
     */
    public function deleted(Testimony $testimony)
    {
        //
    }

    /**
     * Handle the Testimony "restored" event.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return void
     */
    public function restored(Testimony $testimony)
    {
        //
    }

    /**
     * Handle the Testimony "force deleted" event.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return void
     */
    public function forceDeleted(Testimony $testimony)
    {
        //
    }
}
