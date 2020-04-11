<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    protected $table='tagihan_siswa';

    public function pembayarans()
    {
        return $this->hasMany('App\BayarTagihanSiswa', 'id', 'tagihan_id');
    }
    
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }


}
