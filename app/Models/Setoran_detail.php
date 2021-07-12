<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'groupPayment_id','setoran_id'
    ];


    public function groupPayment(){
        return $this->belongsTo('App\Models\Group_payment');
    }

    public function setoran(){
        return $this->belongsTo('App\Models\Setoran');
    }
}
