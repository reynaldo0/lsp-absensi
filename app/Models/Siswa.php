<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = ['id'];

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
    public function selfies()
    {
        return $this->hasMany(Selfie::class);
    }
}
