<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenjang-list|jenjang-create|jenjang-edit|jenjang-delete', ['only' => ['index','store']]);
        $this->middleware('permission:jenjang-create', ['only' => ['create','store']]);
        $this->middleware('permission:jenjang-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:jenjang-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenjang = Jenjang::all();
        $params = [
            'title'=>'Daftar Jenjang Tingkatan',
            'data'=> $jenjang,
        ];
        
        return view('admin.jenjang.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $param = [
            'title'=>'Buat Jenjang',
        ];
        return view('admin.jenjang.create')->with($param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jenjang = Jenjang::create([
            'namaJenjang'=>$request->input('namaJenjang'),
            'ket'=>$request->input('ket'),
        ]);
       // \LogActivity::addToLog("Menambahkan Jenjang $jenjang->namaJenjang");
        return redirect()->route('jenjang.index')->with('success',"Jenjang <strong>$jenjang->namaJenjang</strong> berhasil dibuat.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function show(Jenjang $jenjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function edit($jenjang)
    {
        try{
            $jenjang = Jenjang::findOrFail($jenjang);

            $params = [
                'title' => 'Edit Jenjang'.$jenjang,
                'jenjang' => $jenjang,
            ];

            return view('admin.jenjang.edit')->with($params);
            
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
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jenjang)
    {
        try
        {
            
            $jenjang = Jenjang::findOrFail($jenjang);

            $jenjang->namaJenjang = $request->input('namaJenjang');
            $jenjang->ket = $request->input('ket');

            $jenjang->save();
            //\LogActivity::addToLog("Mengedit Jenjang $jenjang->namaJenjang");
            return redirect()->route('jenjang.index')->with('success', "Jenjang <strong>$jenjang->namaJenjang</strong> berhasil di update.");
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
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($jenjang)
    {
        User::find($jenjang)->delete();
        return redirect()->route('jenjang.index')
                        ->with('success','Jenjang deleted successfully');
    }
}
