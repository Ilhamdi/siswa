<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jnsbiayas extends Model
{
    use HasFactory;

    //protected $guarded = [];
    protected $fillable = [
        'namaBiaya',
    ];
    public function setspp(){
        return $this->hasMany('App\Models\Setspps');
     }
     public function payment(){
        return $this->hasMany('App\Models\Payment');
     }
}
