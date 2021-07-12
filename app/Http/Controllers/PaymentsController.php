<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Setsppss;
use App\Models\Tingkat;
use App\Models\Jenjang;
use App\Models\siswas;
use App\Models\Potspps;
use App\Models\Group_payment;
use App\Models\Kelas;
use App\Models\Bendahara;

use DB;
use Auth;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;


use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payment-list|payment-create|payment-edit|payment-delete', ['only' => ['index','store']]);
        $this->middleware('permission:payment-create', ['only' => ['create','store']]);
        $this->middleware('permission:payment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:payment-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $spp = Group_payment::where('user_id','=',Auth::user()->id)
            ->where('created_at','=',$today)
            ->orWhere('status','=','blmSetor')
            ->orderBy('created_at','DESC')
            ->get();
        $jlhBayar = DB::table('payments')->select(
                DB::raw("sum(CASE WHEN jnsbiayas_id='1' then amount else NULL END) as calon1"),
                DB::raw("sum(CASE WHEN jnsbiayas_id='3' THEN amount ELSE NULL END) as calon2")
            )->where('created_at','=',$today)->get();
           // ->orWhere('status','=','blmSetor')->get();

        $jlhSpp = Payments::where('user_id','=',Auth::user()->id)
            ->where('created_at','=',$today)
           // ->orWhere('status','=','blmSetor')
            ->get();
            

        $params = [
            'title'=>'Daftar Pembayaran SPP',
            'bendahara'=> $bendahara,
            'spp'=>$spp,
            'jlhBayar'=>$jlhBayar,
            'jlhSpp'=>$jlhSpp,
        ];
        
        return view('admin.spp.pembayaranSpp_list')->with($params);
    }

    public function setoranSpp()
    {
        
        $today = date('Y-m-d');
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $jenjang = Jenjang::where('id','=',$bendahara->jenjang_id)->first();
         
        $spp = DB::table('payments')
            ->select('potspps.amount as pot','payments.id','siswas.nama','kelas.namaKelas','payments.created_at',DB::raw('SUM(payments.amount) as total'))->groupBy('payments.group_payments_id')
            ->leftjoin('siswas','payments.siswa_id','siswas.id')
            ->leftjoin('potspps','potspps.siswa_id','siswas.id')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->where('payments.status','=','blmSetor')
            ->where('payments.jnsbiayas_id','=','1')
            ->orderBy('payments.created_at','DESC')
            ->get();

        $jlhSpp = Payments::select(DB::raw('SUM(payments.amount) as total'))->where('user_id','=',Auth::user()->id)
            ->where('created_at','=',$today)
            ->orWhere('status','=','blmSetor')
            ->where('jnsbiayas_id','=','1')->groupBy('payments.group_payments_id')
            ->orderBy('created_at','DESC')
            ->get();

        
        
        $param = [
            'title'=>'Setoran SPP',
            'jenjang'=> $jenjang,
            'spp'=>$spp,
            'jlhSpp'=>$jlhSpp,
            
        ];
        return view('admin.setoran.setoranSpp')->with($param);
    }
    public function dataPembayaranSpp(Request $request)
    {
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $jenjang = Jenjang::where('id','=',$bendahara->jenjang_id)->first();
        $today = date('Y-m-d');
         
        
        $spp = Group_payment::where('user_id','=',Auth::user()->id)
           // ->whereBetween('updated_at',[$today.' 00:00:00',$today.' 23:59:59'])
            ->whereMonth('created_at',Carbon::now()->month)
            ->orderBy('created_at','DESC')
            ->get();

        $jlhBayar = DB::table('payments')->select(
                DB::raw("sum(CASE WHEN jnsbiayas_id='1' then amount else NULL END) as calon1"),
                DB::raw("sum(CASE WHEN jnsbiayas_id='3' THEN amount ELSE NULL END) as calon2")
            )->get();

        $jlhSpp = Payments::where('user_id','=',Auth::user()->id)
            ->get();


        
        $param = [
            'title'=>'Data Pembayaran SPP',
            'jenjang'=> $jenjang,
            'spp'=>$spp,
            'jlhBayar'=>$jlhBayar,
            'jlhSpp'=>$jlhSpp,
            
        ];
        return view('admin.laporan.dataPembayaranSpp')->with($param);
    }

    public function dataRangeDate(Request $request)
    {
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();

        if($request->ajax()){
            if($request->from_date != '' && $request->to_date != '')
            {
                $spp = Group_payment::where('user_id','=',Auth::user()->id)
                ->whereBetween('updated_at',[$request->from_date.' 00:00:00',$request->to_date.' 23:59:59'])
               // ->whereMonth('created_at',Carbon::now()->month)
                ->orderBy('created_at','DESC')
                ->get();
            }
            else
            {
                $spp = Group_payment::where('user_id','=',Auth::user()->id)
               // ->whereBetween('updated_at',[$today.' 00:00:00',$today.' 23:59:59'])
                ->whereMonth('created_at',Carbon::now()->month)
                ->orderBy('created_at','DESC')
                ->get();
            }
        }
        

            echo json_encode($spp);

    }

    public function cekSpp(Request $request)
    {
        list($a,$b) = explode('/',$request->id);
            $from = $b."-".$a."-01";
            $date_for_database = date('Y-m-d', strtotime($from));
        $spp = Payments::select('month')
             ->where('month','=',$date_for_database)
             ->where('siswa_id','=',$request->siswa)
             ->first();
           
        return response()->json($spp);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = siswas::pluck('nama','nama')->all();
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $siswa = DB::table('siswas')
            ->select('siswas.id','siswas.nama','kelas.namaKelas','jenjangs.namaJenjang')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->where('jenjangs.id','=',$bendahara->jenjang_id)
            ->get();
        $tingkat = Tingkat::all();
        $param = [
            'title'=>'Tambah Potongan SPP',
            'siswa'=>$siswa,
            'tingkat'=>$tingkat,
        ];
        return view('admin.spp.pembayaranSpp_create')->with($param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {

            $today = date('Y-m-d');

            $group = Group_payment::create([
                    'tglBayar'=>$today,
                    'totalBayar'=> '0',
                    'user_id'=> Auth::user()->id,
                    'siswa_id'=> $request->idSiswa,
                    'thnAjaran'=>$request->thnAjaran,
                    'kelas_id'=>$request->idKelas,

             ]);
            $xx = DB::table('group_payments')
                ->select('id','siswa_id')
                ->first();

                        
            //\LogActivity::addToLog("Pembayaran  SPP ".$group->siswa->nama." kelas ".$group->siswa->kelas->namaKelas);
            return redirect()->route('grouppayment.edit',  $group->id)->with('success',"Data Siswa sudah dicocokan. ");
            
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(Payments $payments)
    {
        $today = date('Y-m-d');
        $jenjang = Jenjang::where('user_id','=',Auth::user()->id)->first();
       

        $param = [
            'title'=>'Pembayaran SPP',
            'jenjang'=> $jenjang,
            'today'=>$today,
            
        ];
        return view('admin.spp.pembayaranSpp_edit')->with($param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
