<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'telp','jabatan','user_id','jenjang_id'
    ];

    public function jenjang(){ 
        return $this->belongsTo('App\Models\Jenjang');
    }
    public function user(){ 
        return $this->belongsTo('App\Models\User');
    }
}
