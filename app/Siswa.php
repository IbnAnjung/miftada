<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Siswa extends Model
{
    use softDeletes;

    protected $table= 'siswa';

    public function status()
    {
        return $this->belongsTo(StatusSiswa::class, 'status_siswa_id','id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * many to many relationship wih tagian table
     */
    public function tagihan()
    {
        /*
        return $this->belongsToMany(Tagihan::class, 'tagihan_siswa', 'siswa_id', 'tagihan_id')
            ->withPivot('potongan', 'bayar', 'id')
            ->withTimestamps();
        */

        return $this->belongsToMany('App\Tagihan', 'tagihan_siswa', 'siswa_id', 'tagihan_id')
            ->withPivot('potongan', 'bayar', 'id');
    }

    /**
     * has many relationship with tagihan table
     */
    public function tagihanSiswa()
    {
        return $this->hasMany(TagihanSiswa::class);
    }

    
}
