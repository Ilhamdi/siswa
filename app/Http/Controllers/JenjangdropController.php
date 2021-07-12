<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\siswas;

use App\Models\User;
use Auth;
use Session;
use DB;

class JenjangdropController extends Controller
{
    public function getKelas(Request $request)
    {
    	$kelas = DB::table('kelas')
            ->select('kelas.id','kelas.namaKelas','kelas.waliKelas')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->where('tingkats.id','=',$request->id)->pluck('namaKelas','id','3');
            return response()->json($kelas);
    }
    public function getTingkat(Request $request)
    {
    	$tingkat = DB::table('tingkats')
            ->select('tingkats.id','tingkats.nama')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->where('jenjangs.id','=',$request->id)->pluck('nama','id','3');
            return response()->json($tingkat);
    }
    public function getSiswa(Request $request)
    {
        $datasiswa = DB::table('siswas')->distinct()
        ->select ('siswas.id','siswas.nis','siswas.nama','kelas.namaKelas')
        ->leftjoin('kelas','siswas.kelas_id','kelas.id')
        ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
        ->where('tingkats.id','=',$request->id)->pluck('nama','nis','3');
        return response()->json($datasiswa);
    }
    public function getNama(Request $request)
    {
        
        $datasiswa = DB::table('siswas')
            ->select('siswas.id','siswas.nis','siswas.nama','siswas.hpOrtu','kelas.namaKelas','kelas.id AS c','jenjangs.namaJenjang','setspps.amount AS a','potspps.amount AS b')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->leftjoin('setspps','setspps.tingkat_id','tingkats.id')
            ->leftjoin('potspps','potspps.siswa_id','siswas.id')
           ->where('siswas.nis','=',$request->id)
           ->orWhere('siswas.id','=',$request->id)->first();
        return response()->json($datasiswa);
    }
}
