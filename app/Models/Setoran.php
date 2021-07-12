<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;
    protected $fillable = [
        'desk','amount','status','user_id','tglSetor'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

     public function setoranDetail(){
        return $this->hasMany('App\Models\Setoran_detail');
    }
}
