<?php

namespace App\Http\Controllers;

use App\Models\Setspps;
use App\Models\Tingkat;
use App\Models\Jenjang;
use App\Models\Siswa;
use App\Models\jnsbiayas;
use Illuminate\Http\Request;

class SetsppsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setSpp-list|setSpp-create|setSpp-edit|setSpp-delete', ['only' => ['index','store']]);
        $this->middleware('permission:setSpp-create', ['only' => ['create','store']]);
        $this->middleware('permission:setSpp-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:setSpp-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tingkat = Tingkat::all();
        
        $spp = Setspps::all();
        $params = [
            'title'=>'Daftar kelas ',
            'tingkat'=> $tingkat,
            'spp'=>$spp,
        ];
        
        return view('admin.spp.setSpp_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkat = Tingkat::all();
        $jnsBiaya = jnsbiayas::all();
        $param = [
            'title'=>'Buat Kelas',
            'jnsBiaya'=>$jnsBiaya,
            'tingkat'=>$tingkat,
        ];
        return view('admin.spp.Setspp_create')->with($param);
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
            $this->validate($request,[
                'nama'=> 'required',
                'tingkat' => 'required',
                'thnAjaran' => 'required',
                'amount' => 'required',
                'status' => 'required',
                'desk' => 'required',
            ]);
            $angka= str_replace(".", "", $request->amount);
            $spp = Setspps::create([
                'nama'=>$request->nama,
                'amount'=>$angka,
                'thnAjaran'=>$request->thnAjaran,
                'desk'=>$request->desk,
                'status'=>$request->status,
                'tingkat_id'=>$request->tingkat,
                'jnsbiaya_id'=>$request->jns,
            ]);
            
            
          //  \LogActivity::addToLog("Menambahkan Besaran Biaya $spp->nama");
            return redirect()->route('setSpp.index')->with('success',"Menambahkan Besaran Biaya $spp->nama berhasil dibuat.");
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
     * @param  \App\Models\Setspps  $setspps
     * @return \Illuminate\Http\Response
     */
    public function show(Setspps $setspps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setspps  $setspps
     * @return \Illuminate\Http\Response
     */
    public function edit($setspps)
    {
        try{
            $spp = Setspps::findOrFail($setspps);
            
            $jnsBiaya = jnsbiayas::all();
            $tingkat= Tingkat::all();

            $params = [
                'title' => 'Edit Besaran Biaya',
                'tingkat' => $tingkat,
                'jnsBiaya'=> $jnsBiaya,
                'spp'=> $spp,
            ];

            return view('admin.spp.setSpp_edit')->with($params);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setspps  $setspps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $setspps)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setspps  $setspps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setspps $setspps)
    {
        //
    }
}
