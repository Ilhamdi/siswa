<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'amount','paid','returnMoney','desk','month','siswa_id','user_id','group_payments_id','thnAjaran','kelas','group_payments_id','jnsbiayas_id','kelas_id'
    ];
                
    public function siswa(){
        return $this->belongsTo('App\Models\siswas');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

     public function setoranDetail(){
        return $this->hasMany('App\Models\Setoran_detail');
        }

    public function group_payment(){
        return $this->belongsTo('App\Models\Group_payment');
    }
    public function jns_Biaya(){
        return $this->belongsTo('App\Models\Jnsbiayas');
    }
    public function kelas(){
        return $this->belongsTo('App\Models\Kelas');
    }
}
