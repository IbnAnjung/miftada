<?php

namespace App\Observers;

use App\Tagihan;

class TagihanObserver
{   

    /**
     * Handle the tagihan "creating" event
     * @param \App\Tagihan $tagihan
     * @return void
     */
    public function creating(Tagihan $tagihan)
    {

        $tagihan->created_by = \Auth::user()->id;

    }

    /**
     * Handle the tagihan "created" event.
     *
     * @param  \App\Tagihan  $tagihan
     * @return void
     */
    public function created(Tagihan $tagihan)
    {
        //
    }

    /**
     * Handle the tagihan "updating" event
     * @param \App\Tagihan $tagihan
     * @return void
     */
    public function updating(Tagihan $tagihan)
    {

        $tagihan->updated_by = \Auth::user()->id;

    }

    /**
     * Handle the tagihan "updated" event.
     *
     * @param  \App\Tagihan  $tagihan
     * @return void
     */
    public function updated(Tagihan $tagihan)
    {
        //
    }

    /**
     * Handle the tagihan "deleted" event.
     *
     * @param  \App\Tagihan  $tagihan
     * @return void
     */
    public function deleted(Tagihan $tagihan)
    {
            $tagihan->deleted_by = \Auth::user()->id;
    }

    /**
     * Handle the tagihan "restored" event.
     *
     * @param  \App\Tagihan  $tagihan
     * @return void
     */
    public function restored(Tagihan $tagihan)
    {
        //
    }

    /**
     * Handle the tagihan "force deleted" event.
     *
     * @param  \App\Tagihan  $tagihan
     * @return void
     */
    public function forceDeleted(Tagihan $tagihan)
    {
        //
    }
}
