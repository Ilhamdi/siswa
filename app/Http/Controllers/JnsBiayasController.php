<?php

namespace App\Http\Controllers;

use App\Models\Jnsbiayas;
use Illuminate\Http\Request;


class JnsBiayasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jns_biaya = Jnsbiayas::all();
        $params = [
            'title'=>'Daftar kelas ',
            'data'=> $jns_biaya,
        ];
        
        return view('admin.jnsBiaya.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $param = [
            'title'=>'Jenis Biaya',
        ];
        return view('admin.jnsBiaya.create')->with($param);
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
            ]);
            
            $jns_biaya = Jnsbiayas::create([
                'namaBiaya'=>$request->nama,
            ]);
            
            
            //\LogActivity::addToLog("Menambahkan Kelas $kelas->namaKelas");
            return redirect()->route('jnsBiaya.index')->with('success',"Jenis Biaya <strong>$jns_biaya->namaBiaya </strong> berhasil dibuat.");
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
     * @param  \App\Models\jns_biayas  $jns_biayas
     * @return \Illuminate\Http\Response
     */
    public function show(JnsBiayas $jns_biayas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jns_biayas  $jns_biayas
     * @return \Illuminate\Http\Response
     */
    public function edit($jns_biayas)
    {
        try{
            
            $biaya = Jnsbiayas::findOrFail($jns_biayas);
           

            $params = [
                'title' => 'Edit Tingkat',
                'biaya' => $biaya,
            ];

            return view('admin.jnsBiaya.edit')->with($params);
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
     * @param  \App\Models\jns_biayas  $jns_biayas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jns_biayas)
    {
        try
        {
            
            $biaya = Jnsbiayas::findOrFail($jns_biayas);

            $biaya->namaBiaya = $request->input('nama');

            $biaya->save();
            //\LogActivity::addToLog("Mengedit tingkat $tingkat->nama");
            return redirect()->route('jnsBiaya.index')->with('success', "Biaya<strong>$biaya->namaBiaya</strong> berhasil di update.");

            
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
     * @param  \App\Models\JnsBiayas  $jns_biayas
     * @return \Illuminate\Http\Response
     */
    public function destroy($jns_biayas)
    {
        try
        {
            $biaya = Jnsbiayas::findOrFail($jns_biayas);

            $biaya->delete();
           // \LogActivity::addToLog("Menghapus tingkat $tingkat->nama");
            return redirect()->route('jnsBiaya.index')->with('success', "Biaya <strong>$biaya->namaBiaya </strong> sudah di Hapus.");
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
