<?php

namespace App\Observers;

use App\StatusSiswa;

class StatusSiswaObserver
{
    /**
     * Handel the status kelas "creating" event
     * 
     * @param \App\StatusSiswa $statusSiswa
     * @return void
     */
    public function creating(StatusSiswa $statusSiswa)
    {

       $statusSiswa->created_by = \Auth::user()->id; 

    }
    
    /**
     * Handle the status kelas "created" event.
     *
     * @param  \App\StatusSiswa  $statusSiswa
     * @return void
     */
    public function created(StatusSiswa $statusSiswa)
    {
        //
    }

    /**
     * Handle the status kelas "updating" event
     * 
     * @param \App\StatusSiswa $statusSiswa
     * @return void
     */
    public function updating(StatusSiswa $statusSiswa)
    {

        $statusSiswa->updated_by = \Auth::user()->id;

    }

    /**
     * Handle the status kelas "updated" event.
     *
     * @param  \App\StatusSiswa  $statusSiswa
     * @return void
     */
    public function updated(StatusSiswa $statusSiswa)
    {
        
    }

    /**
     * Handle the status kelas "deleted" event.
     *
     * @param  \App\StatusSiswa  $statusSiswa
     * @return void
     */
    public function deleted(StatusSiswa $statusSiswa)
    {
        
        $stautsSiswa->deleted_by = \Auth::user()->id;

    }

    /**
     * Handle the status kelas "restored" event.
     *
     * @param  \App\StatusSiswa  $statusSiswa
     * @return void
     */
    public function restored(StatusSiswa $statusSiswa)
    {
        //
    }

    /**
     * Handle the status kelas "force deleted" event.
     *
     * @param  \App\StatusSiswa  $statusSiswa
     * @return void
     */
    public function forceDeleted(StatusSiswa $statusSiswa)
    {
        //
    }
}
