<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Http\Request;

use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

use App\Models\Payments;
use App\Models\Jenjang;
use App\Models\Setoran_detail;
use App\Models\Group_payment;
use App\Models\User;
use App\Models\Bendahara;

class SetoranController extends Controller
{
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
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $jenjang = Jenjang::where('id','=',$bendahara->jenjang_id)->first();
         $this->validate($request,[
                'desk' => 'required',
            ]);
            
            $amount= str_replace(".", "", $request->amount);
            $tglSetor = date('Y-m-d');

            $setoran = Setoran::create([
                'desk'=>$request->desk,
                'tglSetor'=>$tglSetor,
                'amount'=>$amount,
                'status'=> 'proses',
                'user_id'=>Auth::user()->id,
            ]);

            
            $spp = Group_payment::where('user_id','=',Auth::user()->id)
                ->where('status','=','blmSetor')
                ->get();



            $siswaCount = $spp->count();
                   // for($i=0;$i<$siswaCount;$i++){
                        $i=0;
                        foreach ($spp as $key => $value) {
                        $payID = $spp[$i]->id;
                            
                        $detail = Setoran_detail::create([
                            'group_payments_id'=>$payID,
                            'setoran_id'=>$setoran->id,
                            
                         ]);
                            
                            $payment = Payments::where('group_payments_id','=', $payID)->get();
                            $j=0;
                            foreach ($payment as $key => $value) {
                                $paymentSet = Payments::findOrFail($value->id);
                                $paymentSet->status = 'sdhSetor';
                                $paymentSet->save();
                                
                            }

                            $group = Group_payment::findOrFail($payID);
                                $group->status = 'sdhSetor';
                                $group->save();
                            
                        //\LogActivity::addToLog(" $setoran->id sebesar ".$spp[$i]->id);
                        $i=$i+1;
                      }

            //\LogActivity::addToLog(" Bendahara $jenjang->namaJenjang melakukan penyetoran SPP sebesar $amount ");
             return redirect()->route('setoranSpp')->with('success',"$tglSetor Penyetoran SPP berhasil");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setoran  $setoran
     * @return \Illuminate\Http\Response
     */
    public function show(Setoran $setoran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setoran  $setoran
     * @return \Illuminate\Http\Response
     */
    public function edit(Setoran $setoran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setoran  $setoran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setoran $setoran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setoran  $setoran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setoran $setoran)
    {
        //
    }
}
