<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potspps extends Model
{
    use HasFactory;
    protected $fillable = [
        'desk', 'amount','status','siswa_id'
    ];

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswas');
    }
}
