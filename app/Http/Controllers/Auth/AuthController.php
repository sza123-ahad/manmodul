<?php

namespace App\Http\Controllers\Auth;
// namespace Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    //
    public function index(){
        return view('auth.login');;
    }

    public function proseslogin(Request $request){
        // dd($request->all());
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

         if(Auth::attempt($request->only('username','password'))){
                $akses = [
                    'superadmin',
                ];
               
                foreach($akses as $item){
                    if(auth()->user()->akses == $item){
                        $redirect = $item.'/beranda';
                        return redirect($redirect);
                    }
                }
            }  
        return back()->with(['type'=>'error','message'=>'username atau password salah']); 
    }
    public function logout(){
        auth()->logout();
        session()->flash('message','Anda Telah Keluar Sistem');
        return redirect('');   
    }
}
