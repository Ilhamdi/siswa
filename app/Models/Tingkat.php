<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'jenjang_id'
    ];

    public function jenjang(){ 
        return $this->belongsTo('App\Models\Jenjang');
    }
    public function kelas(){
        return $this->hasMany('App\Models\Kelas');
     }
     public function setSpp(){
        return $this->hasMany('App\Models\Setspp');
     }
}
