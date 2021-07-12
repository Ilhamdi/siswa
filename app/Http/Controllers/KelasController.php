<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jenjang;
use App\Models\Tingkat;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index','store']]);
        $this->middleware('permission:kelas-create', ['only' => ['create','store']]);
        $this->middleware('permission:kelas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        $params = [
            'title'=>'Daftar kelas ',
            'data'=> $kelas,
        ];
        
        return view('admin.kelas.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkat = Tingkat::all();
        $param = [
            'title'=>'Buat Kelas',
            'tingkat'=>$tingkat,
        ];
        return view('admin.kelas.create')->with($param);
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
                'waliKelas' => 'required',
                'desk' => 'required',
            ]);
            
            $kelas = Kelas::create([
                'namaKelas'=>$request->nama,
                'waliKelas'=>$request->waliKelas,
                'deskripsi'=>$request->desk,
                'tingkat_id'=>$request->tingkat,
            ]);
            
            
            //\LogActivity::addToLog("Menambahkan Kelas $kelas->namaKelas");
            return redirect()->route('kelas.index')->with('success',"Kelas <strong>$kelas->namaKelas </strong> berhasil dibuat.");
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
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($kelas)
    {
        try{
            $kelas = Kelas::findOrFail($kelas);
            $tingkat= Tingkat::all();

            $params = [
                'title' => 'Edit Tingkat',
                'tingkat' => $tingkat,
                'kelas'=>$kelas,
            ];

            return view('admin.kelas.edit')->with($params);
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
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas)
    {
        try
        {
            
            $kelas = Kelas::findOrFail($kelas);

            $kelas->namaKelas = $request->input('nama');
            $kelas->waliKelas = $request->input('waliKelas');
            $kelas->tingkat_id = $request->input('tingkat');
            $kelas->deskripsi = $request->input('desk');

            $kelas->save();
            //\LogActivity::addToLog("Mengedit tingkat $tingkat->nama");
            return redirect()->route('kelas.index')->with('success', "Kelas<strong>$kelas->namaKelas</strong> berhasil di update.");

            
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
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        try
        {
            $kelas = Kelas::findOrFail($kelas->id);

            $kelas->delete();
           // \LogActivity::addToLog("Menghapus tingkat $tingkat->nama");
            return redirect()->route('kelas.index')->with('success', "tingkat <strong>$kelas->nama </strong> sudah di Hapus.");
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
