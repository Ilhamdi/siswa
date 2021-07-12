<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis', 'nama','gender','thnMasuk','bapak','ibu','hpOrtu','agama','foto','alamat','user_id','kelas_id',

    ];
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function kelas(){
        return $this->belongsTo('App\Models\kelas');
    }
    public function potspp(){
        return $this->hasOne('App\Models\Potspps');
     }
    public function group_payment(){
        return $this->hasMany('App\Models\Group_payment');
     }
}
