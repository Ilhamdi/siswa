<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\SiswasImport;
use App\Models\siswas;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Jenjang;
use App\Models\Bendahara;

use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Image;
use Excel;

class SiswasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:siswa-list|siswa-create|siswa-edit|siswa-delete', ['only' => ['index','store']]);
        $this->middleware('permission:siswa-create', ['only' => ['create','store']]);
        $this->middleware('permission:siswa-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:siswa-delete', ['only' => ['destroy']]);
    }

    public function dataSiswa()
    {
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $jenjang = Jenjang::where('id','=',$bendahara->jenjang_id)->first();

        
        $today = date('m');
        $siswa = siswas::get();

        
        
        // $sppSiswa = Payment::whereYear('month','=',date('Y'))
        //     ->whereMonth('month','=',date('m'))
        //     ->get();
        
       // $datasiswa = siswas::all();
        
        $datasiswa = DB::table('siswas')->distinct()
            ->select ('siswas.id','siswas.nama','kelas.namaKelas','jenjangs.namaJenjang')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->where('jenjangs.id','=',$jenjang->id)
            ->orderBy('siswas.created_at','DESC')
            ->get();
        $params = [
            'title'=>'Daftar Siswa '.$today,
            'jenjang'=>$jenjang,
            'datasiswa'=>$datasiswa,
          //  'sppSiswa'=>$sppSiswa,
            'siswa'=>$siswa,
            //'kelas'=>$kelas,
        ];
        
        return view('admin.siswa.data_siswa')->with($params);
    }

    public function importSiswa()
    {
        $jenjang = Jenjang::all();
        $siswa = siswas::all();
        $param = [
            'title'=>'Import Data',
            'jenjang'=>$jenjang,
            'siswa'=>$siswa,
            
        ];
        return view('admin.siswa.siswa_import')->with($param);
    }

    public function importExcel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        
        if($request->hasFile('file')){
            $path = $request->file('file');
            $import = new SiswasImport();
            $ts = Excel::import($import, $path);

            $i=0;
            $data = $import->getSheetNames()['Sheet1'];
            
            while(isset($data[$i]))
            {
                
                    $user = User::create([
                            'username'=>$data[$i]['nis'],
                            'password'=>Hash::make('12345678'),
                            'name'=>$data[$i]['nama'],
                        ]);
                    $role_r = Role::where('name', '=', 'Siswa')->firstOrFail();
                    $user->assignRole($role_r);

                     $siswa = siswas::create([
                            'nis'=>$data[$i]['nis'],
                            'nama'=>$data[$i]['nama'],
                            'gender'=>$data[$i]['gender'],
                            'thnMasuk'=>$data[$i]['thnmasuk'],
                            'bapak'=>$data[$i]['bapak'],
                            'ibu'=>$data[$i]['ibu'],
                            'hpOrtu'=>$data[$i]['hportu'],
                            'agama'=>$data[$i]['agama'],
                            'alamat'=>$data[$i]['alamat'],
                            'user_id'=>  $user->id,
                            'kelas_id'=>$request->kelas,
                
                         ]);

                $i++;
            }
            
            
                
         }

        return redirect()->route('siswa.index')->with('success', "  Data Siswa  Berhasil di tambahkan. ");
    }

    public function kenaikan()
    {
        $bendahara = Bendahara::where('user_id','=',Auth::user()->id)->first();
        $jenjang = Jenjang::where('id','=',$bendahara->jenjang_id)->first();
        $today = date('m');
        $kelas = DB::table('kelas')->distinct()
            ->select ('kelas.id','kelas.namaKelas')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->where('jenjangs.id','=',$jenjang->id)
            ->get();
        $datasiswa = DB::table('siswas')->distinct()
            ->select ('siswas.id','siswas.nama','kelas.namaKelas','jenjangs.namaJenjang')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->where('jenjangs.id','=',$jenjang->id)
            ->orderBy('siswas.created_at','DESC')
            ->get();
        $params = [
            'title'=>'Daftar Siswa '.$today,
            'jenjang'=>$jenjang,
            'datasiswa'=>$datasiswa,
          //  'sppSiswa'=>$sppSiswa,
            
            'kelas'=>$kelas,
        ];
        
        return view('admin.siswa.kenaikanKelas')->with($params);

        
    }

    public function kenaikanSiswa(Request $request)
    {
        if($request->to){

            $siswa = Siswas::where('kelas_id','=',$request->from)->get();

            foreach ($siswa as $key ) {
                $kenaikan = Siswas::findOrFail($key->id);
                $kenaikan->kelas_id= $request->to;
                $kenaikan->save();
            }

            //\LogActivity::addToLog("Mengubah Kenaikan Kelas $request->from menjadi $request->to.");
            return redirect()->route('datasiswa')->with('success', " Berhasil mengubah kelas. ");

        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datasiswa = DB::table('siswas')->get();
        $datasiswa = DB::table('siswas')->distinct()
            ->select ('siswas.id','siswas.nama','kelas.namaKelas','jenjangs.namaJenjang')
            ->leftjoin('kelas','siswas.kelas_id','kelas.id')
            ->leftjoin('tingkats','kelas.tingkat_id','tingkats.id')
            ->leftjoin('jenjangs','tingkats.jenjang_id','jenjangs.id')
            ->orderBy('siswas.created_at','DESC')
            ->get();
        

        $params = [
            'title'=>'Data Siswa ',
            'datasiswa'=> $datasiswa,
        ];
        
        return view('admin.siswa.data_siswa')->with($params);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenjang = Jenjang::all();
        $siswa = siswas::all();
        $param = [
            'title'=>'Tambah Siswa',
            'jenjang'=>$jenjang,
            'siswa'=>$siswa,
        ];
        return view('admin.siswa.create')->with($param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'jenjang'=>'required|integer',
            'kelas'=>'required|integer',
            'nis'=>'required|max:6',
            //'email'=>'required|email|unique:users',
            'nama'=>'required|max:120',
            'foto'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $users = Auth::user()->getRoleNames();
        $user = User::create([
            'username'=>$request->nis,
            'password'=>Hash::make('12345678'),
            'name'=>$request->nama,
        ]);
        $role_r = Role::where('name', '=', 'Siswa')->firstOrFail();
        $user->assignRole($role_r);

        $filename='';
        $post_thumbnail='';
        if( $request->foto) {
            $post_thumbnail     = $request->foto;
            $filename           = time() . '.' . $post_thumbnail->getClientOriginalExtension();
            
            $destinationPath = public_path('/images/siswa');
            $img = Image::make($post_thumbnail->getRealpath());
            $img->resize(100,100,function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);


            
            
            //$request->foto->move("images/siswa", $filename);
            
            
        }

        $siswa = siswas::create([
            'user_id'=> $user->id,
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'gender'=>$request->gender,
            'thnMasuk'=>$request->thnMasuk,
            'bapak'=>$request->bapak,
            'ibu'=>$request->ibu,
            'hpOrtu'=>$request->hpOrtu,
            'agama'=>$request->agama,
            'alamat'=>$request->alamat,
            'kelas_id'=>$request->kelas,
            'foto'=>$filename,

         ]);
        // \LogActivity::addToLog('Menambahkan Data Siswa '.$user->username);
           
         if($users == 'Bendahara')
         {
         return redirect()->route('datasiswa')->with('success',"Siswa <strong>$siswa->nama </strong> berhasil dibuat.");
         } 
         else{
            return redirect()->route('siswa.index')->with('success',"Siswa <strong>$siswa->nama </strong> berhasil dibuat.");
         } 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswas  $siswas
     * @return \Illuminate\Http\Response
     */
    public function show(siswas $siswas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswas  $siswas
     * @return \Illuminate\Http\Response
     */
    public function edit($siswas)
    {
        $jenjang = Jenjang::all();
        //$siswa = siswas::where('id','=',$siswas->id)->first();
         
        $siswax = siswas::findOrFail($siswas);
        $param = [
            'title'=>'Edit Siswa',
            'jenjang'=>$jenjang,
            'siswa'=>$siswax,
        ];
        return view('admin.siswa.edit')->with($param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswas  $siswas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswas $siswa)
    {
        $users = Auth::user()->getRoleNames();
        // $siswa = Siswas::findOrFail($siswa);
        
        // $filename='';
        //     $post_thumbnail='';

        //     if( $request->foto) {
        //             $post_thumbnail     = $request->foto;
        //             $filename           = time() . '.' . $post_thumbnail->getClientOriginalExtension();
                    
        //             if(!file_exists('image/siswa'.$siswa->foto)){
                        
        //                 unlink(public_path().'/image/siswa/'.$siswa->foto);
        //             }
                    
        //             $request->foto->move("image/siswa", $filename);
        //             $siswa->foto = $filename;
                    
        //         }
        // if (Auth::user()->roles()->pluck('name')->implode(' ')=='Siswa'){
        //     $this->validate($request, [
                
        //         'password' => 'same:confirm-password',
        //     ]);
        //     $input = $request->all();
        //     if(!empty($input['password'])){ 
        //         $input['password'] = Hash::make($input['password']);
        //     }else{
        //         $input = array_except($input,array('password'));    
        //     }
        //     $user = User::find($siswa->id);
        //     $user->update($input);
            

        // }
        // else {
        //     //$input = $request->all();
        //     $siswa->nis = $request->input('nis');
        //     $siswa->nama = $request->input('nama');
        //     $siswa->gender = $request->input('gender');
        //     $siswa->thnMasuk = $request->input('thnMasuk');
        //     $siswa->bapak = $request->input('bapak');
        //     $siswa->ibu = $request->input('ibu');
        //     $siswa->hpOrtu = $request->input('hpOrtu');
        //     $siswa->agama = $request->input('agama');
        //     $siswa->alamat = $request->input('alamat');
        //     $siswa->kelas_id= $request->input('kelas');

        // }
        
        // $siswa->save();
       // \LogActivity::addToLog('Data Siswa $siswa->nama telah di ganti');
        
        
        if($users == 'Bendahara')
         {
         return redirect()->route('datasiswa')->with('success',"Siswa <strong>$siswa->nama </strong>$users Berhasil di update.");
         } 
         else{
            return redirect()->route('siswa.index')->with('success',"Siswa <strong>$siswa->nama </strong> Berhasil di update.");
         } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswas  $siswas
     * @return \Illuminate\Http\Response
     */
        
}
