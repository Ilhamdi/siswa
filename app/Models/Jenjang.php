<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaJenjang', 'ket'
    ];

    public function kelas(){
        return $this->hasMany('App\Models\Kelas');
    }
}
