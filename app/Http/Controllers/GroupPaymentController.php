<?php

namespace App\Http\Controllers;

use App\Models\Group_payment;
use Illuminate\Http\Request;

use App\Models\Payments;
use App\Models\Setspps;
use App\Models\Tingkat;
use App\Models\Jenjang;
use App\Models\siswas;
use App\Models\Potspps;
use App\Models\Kelas;
use App\Models\Bendahara;

use DB;
use Hash;
use Auth;
use Spatie\Permission\Models\Role;

class GroupPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:GroupPayment-edit|GroupPayment-delete', ['only' => ['index','store']]);
        $this->middleware('permission:GroupPayment-create', ['only' => ['create','store']]);
        $this->middleware('permission:GroupPayment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:GroupPayment-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group_payment  $group_payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
            $jenjang = Jenjang::where('id','=',$bendahara->jenjang_id)->first();
            $gropPayment = Group_payment::findOrFail($id);

            $params = [
                'title' => 'Hapus Transaksi',
                'gropPayment' => $gropPayment,
                'jenjang'=>$jenjang,
            ];

            return view('admin.spp.pembayaranSpp_delete')->with($params);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group_payment  $group_payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $today = date('Y-m-d');
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $spp = Group_payment::findOrFail($id);
        $siswa = siswas::findOrFail($spp->siswa_id);

        $setspp = Setspps::where('tingkat_id','=',$siswa->kelas->tingkat_id)->get();

        $datasiswa = DB::table('siswas')
            ->select('siswas.id','siswas.nis','siswas.nama','siswas.hpOrtu','kelas.namaKelas','kelas.id AS c','jenjangs.namaJenjang','setspps.amount AS a','potspps.amount AS b')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->leftjoin('setspps','setspps.tingkat_id','tingkats.id')
            ->leftjoin('potspps','potspps.siswa_id','siswas.id')
           ->where('siswas.id','=',$spp->siswa_id)->first();
         

        $detailBayar = DB::table('payments')->select('payments.id','jnsbiayas.id as jnsId','jnsbiayas.namaBiaya','payments.desk','payments.amount')
            ->leftjoin('jnsbiayas','payments.jnsBiayas_id','jnsbiayas.id')
            ->where('payments.group_payments_id','=',$id)->get();


        $param = [
            'title'=>'Pembayaran SPP',
            'bendahara'=> $bendahara,
            'spp'=>$spp,
            'today'=>$today,
            'detailBayar'=>$detailBayar,
            'setspp'=>$setspp,
            'datasiswa' =>$datasiswa,
        ];
        return view('admin.spp.pembayaranSpp_edit')->with($param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group_payment  $group_payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $jlhPembayaran=0;
            $group_payment = Group_payment::findOrFail($id);

            $kelas = Kelas::findOrFail($group_payment->siswa->kelas_id);

            $setspps = Setspps::where('tingkat_id','=',$kelas->tingkat_id)->get();

            $potspp = Potspps::where('siswa_id','=',$request->idSiswa)->first();
            
            foreach ($setspps as $key ) {

                
                //$amount= str_replace(".", "", $request->total);
                list($a,$b) = explode('/',$request->bln);
                $from = $b."-".$a."-01";
                $date_for_database = date('Y-m-d', strtotime($from));
                $desk = $key->nama." ".$request->desk;
                $jlh = 0;
                
                
                if($key->jnsbiaya_id == 1 && $potspp)
                {
                    $pot = ($potspp->amount /100) * $key->amount;
                    $jlh = $key->amount - $pot;
                } 
                else {
                    $jlh = $key->amount;
                }
                
                $jlhPembayaran = $jlhPembayaran + $jlh;
                $spp = Payments::create([
                    'amount'=>$jlh,
                    'desk'=> $desk,
                    'month'=>$date_for_database,
                    'thnAjaran'=>$request->thnAjaran,
                    'siswa_id'=>$request->idSiswa,
                    'user_id'=>Auth::user()->id,
                    'group_payments_id'=>$group_payment->id,
                    'jnsbiayas_id'=>$key->jnsbiaya_id,
                    'kelas_id'=> $group_payment->siswa->kelas_id,
                ]);

            }

           $payment = Payments::where('group_payments_id','=',$id)->get();

            $group_payment->totalBayar = collect($payment)->sum('amount');
            $group_payment->desk = $request->catatan;

            $group_payment->save();

            $isi = "Terima kasih atas pembayaran SPP untuk bulan ".$request->desk;

            // $siswa = siswas::findOrFail($request->idSiswa);
            //     Telegram::sendMessage([
            //      'chat_id'=> $siswa->chatId,
            //      'parse_mode'=>'HTML',
            //      'text'=>$isi
            //     ]);

           
            // \LogActivity::addToLog("Transaksi SPP $desk");
            
            //event(new \App\Events\SendGlobalNotification($request->idSiswa,$jlhPembayaran,$request->desk));
            
            return redirect()->route('grouppayment.edit', $group_payment->id)->with('success',"Transaksi berhasil ditambhakan. ");
            
            //return redirect()->route('grouppayment.edit', ['id' => 25])->with('success',"Transaksi berhasil ditambhakan. ");
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group_payment  $group_payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $gropPayment = Group_payment::findOrFail($id);

            $gropPayment->delete();
            //User::find($siswa->user_id)->delete();
            //\LogActivity::addToLog("Menghapus data transaksi");
            return redirect()->route('payment.index')->with('success', "Pembayaran siswa sudah di Hapus.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
