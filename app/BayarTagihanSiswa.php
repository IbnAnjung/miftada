<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BayarTagihanSiswa extends Model
{
    protected $table= 'bayar_tagihan_siswa';

    public function tagihanSiswa()
    {
        return $this->belongsTo('App\TagihanSiswa',  'tagihan_siswa_id', 'id');
    }

    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
