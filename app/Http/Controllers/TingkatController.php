<?php

namespace App\Http\Controllers;

use App\Models\Tingkat;
use Illuminate\Http\Request;
use App\Models\Jenjang;

class TingkatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tingkat-list|tingkat-create|tingkat-edit|tingkat-delete', ['only' => ['index','store']]);
        $this->middleware('permission:tingkat-create', ['only' => ['create','store']]);
        $this->middleware('permission:tingkat-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tingkat-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tingkat = Tingkat::all();
        $params = [
            'title'=>'Daftar tingkat ',
            'data'=> $tingkat,
        ];
        
        return view('admin.tingkat.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenjang = Jenjang::all();
        $param = [
            'title'=>'Buat tingkat',
            'jenjang'=>$jenjang,
        ];
        return view('admin.tingkat.create')->with($param);
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
                'jenjang' => 'required',
            ]);
            
            $kelas = Tingkat::create([
                'nama'=>$request->nama,
                'jenjang_id'=>$request->jenjang,
            ]);
            
            
           // \LogActivity::addToLog("Menambahkan Tingkatan $kelas->nama");
            return redirect()->route('tingkat.index')->with('success',"Kelas <strong>$kelas->nama </strong> berhasil dibuat.");
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
     * @param  \App\Models\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function show(Tingkat $tingkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function edit(Tingkat $tingkat)
    {
        try{
            $tingkat = Tingkat::findOrFail($tingkat->id);
            $jenjang = Jenjang::all();

            $params = [
                'title' => 'Edit Tingkat',
                'tingkat' => $tingkat,
                'jenjang'=>$jenjang,
            ];

            return view('admin.tingkat.edit')->with($params);
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
     * @param  \App\Models\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tingkat $tingkat)
    {
        try
        {
            
            $tingkat = Tingkat::findOrFail($tingkat->id);

            $tingkat->nama = $request->input('nama');
            $tingkat->jenjang_id = $request->input('jenjang');

            $tingkat->save();
            //\LogActivity::addToLog("Mengedit tingkat $tingkat->nama");
            return redirect()->route('tingkat.index')->with('success', "tingkat <strong>$tingkat->nama</strong> berhasil di update.");
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
     * @param  \App\Models\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tingkat $tingkat)
    {
        try
        {
            $tingkat = Tingkat::findOrFail($tingkat->id);

            $tingkat->delete();
           // \LogActivity::addToLog("Menghapus tingkat $tingkat->nama");
            return redirect()->route('tingkat.index')->with('success', "tingkat <strong>$tingkat->nama </strong> sudah di Hapus.");
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
