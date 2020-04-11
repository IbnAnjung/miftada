<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use softDeletes;

    protected $table= 'kelas';

    public function siswas()
    {
        return $this->hasMany('App\Siswa');
    }
}
