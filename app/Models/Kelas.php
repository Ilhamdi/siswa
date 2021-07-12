<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaKelas', 'waliKelas','deskripsi','tingkat_id'
    ];
    public function tingkat(){
        return $this->belongsTo('App\Models\Tingkat');
    }
    public function siswa(){
        return $this->hasMany('App\Models\siswas');
     }
}
