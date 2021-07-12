<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setspps extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'amount','thnAjaran','desk','status','tingkat_id','jnsbiaya_id',
    ];

    public function tingkat(){
        return $this->belongsTo('App\Models\Tingkat');
    }
    public function jnsbiayas(){
        return $this->belongsTo('App\Models\Jnsbiayas');
    }
}
