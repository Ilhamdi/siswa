<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('preventBackHistory');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showChangePassword(){
        return view('auth.changePassword');
    }
    
    public function changePassword(Request $request){
 
        try
        {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Password Anda tidak cocok dengan database. Silahkan Coba lagi.");
        }
        if(strcmp($request->get('new-password'), $request->get('new-password_confirmation')) != 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Password baru tidak  sama dengan konfirmasi password.");
        }
        

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        // \LogActivity::addToLog('Berhasil mengubah password '. Auth::user()->name);
        return redirect()->back()->with("success","Password changed successfully !" );
       // return redirect()->route('profil')->with('success',"Password berhasil diubah !");
        
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
