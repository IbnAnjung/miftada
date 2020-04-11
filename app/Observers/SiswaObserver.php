<?php

namespace App\Observers;

use App\Siswa;

class SiswaObserver
{

    /**
     * Handle the siswa "creating" event
     * @param \App\Siswa $siswa
     * @return void
     */
    public function creating(Siswa $siswa)
    {

        $siswa->created_by = \Auth::user()->id;

    }

    /**
     * Handle the siswa "created" event.
     *
     * @param  \App\Siswa  $siswa
     * @return void
     */
    public function created(Siswa $siswa)
    {
        //
    }

    /**
     * Hanlde the siswa "updating" event
     * @param \App\Siswa $siswa
     * @return void
     */
    public function updating(Siswa $siswa)
    {
        $siswa->updated_by = \Auth::user()->id;
    }

    /**
     * Handle the siswa "updated" event.
     *
     * @param  \App\Siswa  $siswa
     * @return void
     */
    public function updated(Siswa $siswa)
    {
        //
    }

    /**
     * Handle the siswa "deleted" event.
     *
     * @param  \App\Siswa  $siswa
     * @return void
     */
    public function deleted(Siswa $siswa)
    {
        $siswa->deleted_by = \Auth::user()->id;
    }

    /**
     * Handle the siswa "restored" event.
     *
     * @param  \App\Siswa  $siswa
     * @return void
     */
    public function restored(Siswa $siswa)
    {
        //
    }

    /**
     * Handle the siswa "force deleted" event.
     *
     * @param  \App\Siswa  $siswa
     * @return void
     */
    public function forceDeleted(Siswa $siswa)
    {
        //
    }
}
