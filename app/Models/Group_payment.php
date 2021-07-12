<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'tglBayar','totalBayar','user_id','siswa_id','thnAjaran','kelas_id','status'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function payment(){
        return $this->hasMany('App\Models\Payments');
        }
    public function siswa(){
        return $this->belongsTo('App\Models\siswas');
    }
}
