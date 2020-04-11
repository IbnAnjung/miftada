<?php

namespace App\Observers;
use App\BayarTagihanSiswa;
use App\TagihanSiswa;

class BayarTagihanSiswaObserver
{

    /**
     * Handle the siswa "creating" event
     * @param \App\BayarTagihanSiswa $siswa
     * @return void
     */
    public function creating(BayarTagihanSiswa $bayarTagihanSiswa)
    {

        $bayarTagihanSiswa->created_by = \Auth::user()->id;

        $tagihan = TagihanSiswa::find($bayarTagihanSiswa->tagihan_siswa_id);

        if($tagihan) {
            $tagihan->bayar = $tagihan->bayar + $bayarTagihanSiswa->total;
            $tagihan->save();
        }

    }

    /**
     * Handle the siswa "created" event.
     *
     * @param  \App\BayarTagihanSiswa  $siswa
     * @return void
     */
    public function created(BayarTagihanSiswa $bayarTagihanSiswa)
    {
        
    }

    /**
     * Hanlde the siswa "updating" event
     * @param \App\BayarTagihanSiswa $siswa
     * @return void
     */
    public function updating(BayarTagihanSiswa $bayarTagihanSiswa)
    {
        $tagihan = TagihanSiswa::find($bayarTagihanSiswa->tagihan_siswa_id);
        
        if($tagihan) {
            $tagihan->bayar = $tagihan->bayar - $bayarTagihanSiswa->getOriginal('total') + $bayarTagihanSiswa->total;
            $tagihan->save();
        }
        
        $bayarTagihanSiswa->updated_by = \Auth::user()->id;
    }

    /**
     * Handle the siswa "updated" event.
     *
     * @param  \App\BayarTagihanSiswa  $siswa
     * @return void
     */
    public function updated(BayarTagihanSiswa $bayarTagihanSiswa)
    {

    }

    /**
     * Handle the siswa "deleted" event.
     *
     * @param  \App\BayarTagihanSiswa  $siswa
     * @return void
     */
    public function deleted(BayarTagihanSiswa $bayarTagihanSiswa)
    {
          
        $tagihan = TagihanSiswa::find($bayarTagihanSiswa->tagihan_siswa_id);

        if($tagihan) {
            $tagihan->bayar = $tagihan->bayar - $bayarTagihanSiswa->total;
            $tagihan->save();
        }
    }

    /**
     * Handle the siswa "restored" event.
     *
     * @param  \App\BayarTagihanSiswa  $siswa
     * @return void
     */
    public function restored(BayarTagihanSiswa $bayarTagihanSiswa)
    {
        //
    }

    /**
     * Handle the siswa "force deleted" event.
     *
     * @param  \App\BayarTagihanSiswa  $siswa
     * @return void
     */
    public function forceDeleted(BayarTagihanSiswa $bayarTagihanSiswa)
    {
        //
    }
}
