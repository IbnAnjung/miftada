<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use SoftDeletes;

    protected $table = 'tagihan';

    public function siswas()
    {   
        return $this->belongsToMany('App\Siswa', 'tagihan_siswa', 'tagihan_id', 'siswa_id')
            ->withPivot('potongan', 'bayar', 'id')
            ->withTimestamps();

    }
}
