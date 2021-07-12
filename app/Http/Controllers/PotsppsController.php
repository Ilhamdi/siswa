<?php

namespace App\Http\Controllers;

use App\Models\Potspps;
use App\Models\siswas;
use App\Models\Tingkat;
use App\Models\Setspps;
use Illuminate\Http\Request;

class PotsppsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:potspp-list|potspp-create|potspp-edit|potspp-delete', ['only' => ['index','store']]);
        $this->middleware('permission:potspp-create', ['only' => ['create','store']]);
        $this->middleware('permission:potspp-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:potspp-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $potSpp = Potspps::all();
        $params = [
            'title'=>'Daftar kelas ',
            'potSpp'=>$potSpp,
            
        ];
        
        return view('admin.potSpp.potSpp_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = siswas::pluck('nama','nama')->all();
        $tingkat = Tingkat::all();
        $param = [
            'title'=>'Tambah Potongan SPP',
            'siswa'=>$siswa,
            'tingkat'=>$tingkat,
        ];
        return view('admin.potSpp.potSpp_create')->with($param);
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
            
            $angka= str_replace(".", "", $request->amount);
            $spp = Potspps::create([
                'desk'=>$request->ket,
                'amount'=>$request->pot,
                'status'=>$request->status,
                'siswa_id'=>$request->idSiswa,
            ]);
            
            
           // \LogActivity::addToLog("Menambahkan Jumlah Pot.SPP $spp->desk");
            return redirect()->route('Potspps.index')->with('success',"Potongan <strong>$spp->desk </strong> berhasil dibuat.");
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
     * @param  \App\Models\Potspps  $potspps
     * @return \Illuminate\Http\Response
     */
    public function show(Potspps $potspps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Potspps  $potspps
     * @return \Illuminate\Http\Response
     */
    public function edit($potspps)
    {
        
        $potSpp = Potspps::where('id','=',$potspps)->first();
        $setSpp = Setspps::where('tingkat_id','=',$potSpp->siswa->kelas->tingkat_id)->first() ;
        
        $besaranSpp = $setSpp->amount - (($potSpp->amount * $setSpp->amount)/100);
        $tingkat = Tingkat::all();
        $param = [
            'title'=>'Edit Pot. SPP',
            'tingkat'=>$tingkat,
            'spp'=> $besaranSpp,
            'setspp'=>$setSpp->amount,
            //'jenjang'=>$jenjang,
            'potSpp'=>$potSpp,
        ];
        return view('admin.potSpp.potSpp_edit')->with($param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Potspps  $potspps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $potspps)
    {
        try
        {
            
            $potspps = Potspps::findOrFail($potspps);

            $potspps->desk = $request->input('ket');
            $potspps->amount = $request->input('pot');
            $potspps->status = $request->input('status');
            $potspps->siswa_id = $request->input('idSiswa');

            $potspps->save();
            //\LogActivity::addToLog("Mengedit Jenjang $jenjang->namaJenjang");
            return redirect()->route('Potspps.index')->with('success', "Potongan SPP  berhasil di update.");
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
     * @param  \App\Models\Potspps  $potspps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Potspps $potspps)
    {
        //
    }
}
