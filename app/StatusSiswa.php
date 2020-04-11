<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusSiswa extends Model
{
    protected $table= 'status_siswa';

    public function siswas()
    {
        return $this->hasMany('App\Siswa');
    }
}
