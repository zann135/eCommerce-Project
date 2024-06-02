<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user){
            if($user->level =='1'){
                return redirect()->intended('petani');
            }
            else if($user->level =='2'){
                return redirect()->intended('tengkulak');
            }
            else if($user->level =='3'){
                return redirect()->intended('customer');
            }

        }
        return view('login');
     }
    //
    public function proses_login(Request $request){
      // buat validasi pada saat tombol login di klik
      // validas nya username & password wajib di isi 
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
    
       
       // ambil data request username & password saja 
        $credential = $request->only('username','password');

      // cek jika data username dan password valid (sesuai) dengan data
        if(Auth::attempt($credential)){
           // kalau berhasil simpan data user ya di variabel $user
            $user =  Auth::user();
            // cek lagi jika level user admin maka arahkan ke halaman admin
            if($user->level =='1'){
                return redirect()->intended('petani');
            }
            else if($user->level =='2'){
                return redirect()->intended('tengkulak');
            }
            else if($user->level =='3'){
                return redirect()->intended('customer');
            }
             // jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }

// jika ga ada data user yang valid maka kembalikan lagi ke halaman login
// pastikan kirim pesan error juga kalau login gagal
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal'=>'These credentials does not match our records']);



     }

     public function register(){
      // tampilkan view register
        return view('register');
      }


// aksi form register
      public function proses_register(Request $request){ 
//. kita buat validasi nih buat proses register
 // validasinya yaitu semua field wajib di isi
// validasi username itu harus unique atau tidak boleh duplicate username ya
        $validator =  Validator::make($request->all(),[
            'name'=>'required',
            'username'=>'required|unique:users',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
// kalau gagal kembali ke halaman register dengan munculkan pesan error
        if($validator ->fails()){
            return redirect('/register')
             ->withErrors($validator)
             ->withInput();
        }
// kalau berhasil isi level & hash passwordnya ya biar secure
        $request['level']='user';
        $request['password'] = bcrypt($request->password);

// masukkan semua data pada request ke table user
        User::create($request->all());

         // kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
      }

     public function logout(Request $request){
// logout itu harus menghapus session nya 

        $request->session()->flush();

// jalan kan juga fungsi logout pada auth 

        Auth::logout();
// kembali kan ke halaman login
        return Redirect('login');
      }
}
