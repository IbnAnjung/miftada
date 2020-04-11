<?php

namespace App\Observers;

use App\Kelas;

class KelasObserver
{

    /**
     * Handle the kelas creating event
     */
    public function creating(Kelas $kelas)
    {

        $kelas->created_by = \Auth::user()->id;

    }

    /**
     * Handle the = kelas "created" event.
     *
     * @param  \App\Kelas  $Kelas
     * @return void
     */
    public function created(Kelas $Kelas)
    {
       
    }

    /**
     * handle the Kelas updateing event
     */
    public function updating(Kelas $kelas)
    {

        $kelas->updated_by = \Auth::user()->id;

    }

    /**
     * Handle the = kelas "updated" event.
     *
     * @param  \App\Kelas  $Kelas
     * @return void
     */
    public function updated(Kelas $kelas)
    {
        //
    }

    /**
     * handle the kelas deleting event
     */
    public function deleting(Kelas $kelas)
    {
        
    }

    /**
     * Handle the = kelas "deleted" event.
     *
     * @param  \App\Kelas  $Kelas
     * @return void
     */
    public function deleted(Kelas $kelas)
    {
        $kelas->deleted_by = \Auth::user()->id;
        $kelas->update();
    }

    /**
     * Handle the = kelas "restored" event.
     *
     * @param  \App\Kelas  $Kelas
     * @return void
     */
    public function restored(Kelas $kelas)
    {
        //
    }

    /**
     * Handle the = kelas "force deleted" event.
     *
     * @param  \App\Kelas  $Kelas
     * @return void
     */
    public function forceDeleted(Kelas $kelas)
    {
        //
    }
}
