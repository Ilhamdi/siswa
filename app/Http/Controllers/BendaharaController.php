<?php

namespace App\Http\Controllers;

use App\Models\Bendahara;
use Illuminate\Http\Request;
use App\Models\Jenjang;
use App\Models\User;

use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class BendaharaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bendahara = Bendahara::all();
        $params = [
            'title'=>'Daftar Nama Bendahara',
            'data'=> $bendahara,
        ];
        
        return view('admin.bendahara.index')->with($params);
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
            'title'=>'Buat Bendahara',
            'jenjang'=>$jenjang,
        ];
        return view('admin.bendahara.create')->with($param);
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
                'namaBendahara'=> 'required',
                'jenjang' => 'required',
            ]);

            $user = User::create([
                'username'=>$request->namaBendahara,
                'password'=>Hash::make('12345678'),
                'name'=>$request->namaBendahara,
            ]);
            $role_r = Role::where('name', '=', 'Bendahara')->firstOrFail();
            $user->assignRole($role_r);
            
            $bendahara = Bendahara::create([
                'nama'=>$request->namaBendahara,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'jabatan'=>$request->jabatan,
                'jenjang_id'=>$request->jenjang,
                'user_id' =>  $user->id,
            ]);
            
            
           // \LogActivity::addToLog("Menambahkan Tingkatan $kelas->nama");
            return redirect()->route('bendahara.index')->with('success',"Berhasil dibuat.");
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
     * @param  \App\Models\Bendahara  $bendahara
     * @return \Illuminate\Http\Response
     */
    public function show(Bendahara $bendahara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bendahara  $bendahara
     * @return \Illuminate\Http\Response
     */
    public function edit(Bendahara $bendahara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bendahara  $bendahara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bendahara $bendahara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bendahara  $bendahara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bendahara $bendahara)
    {
        //
    }
}
