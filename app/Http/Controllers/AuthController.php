<?php

namespace App\Http\Controllers;

use App\Models\TagMeta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function gagal(){
		Session::flash('gagal','Kredensial Salah. Coba Lagi.');
		return redirect('/admin/access');
	}

    public function index(){
        // kita ambil data user lalu simpan pada variable $user
         $user = Auth::user();
         $tagmeta = TagMeta::first();
         
         // kondisi jika user nya ada
         if($user){
             // jika user nya memiliki level admin
             if($user->level =='admin'){
                  // arahkan ke halaman admin ya :P
                 return redirect()->intended('admin');
             }
               // jika user nya memiliki level user
             else if($user->level =='user'){
                // arahkan ke halaman user
                 return redirect()->intended('user');
             }

         }
        //  return view('cms.login.login');
         return view('cms.login.login_aside', compact('tagmeta'));
    }
     //
    public function proses_login(Request $request){
       // kita buat validasi pada saat tombol login di klik
       // validas nya username & password wajib di isi
         $request->validate([
             'username'=>'required',
             'password'=>'required'
         ]);


        // ambil data request username & password saja
         $credential = $request->only('username','password');

       // cek jika data username dan password valid (sesuai) dengan data
         if(Auth::attempt($credential)){
            return redirect()->intended('/dashboard');
         }else{
            // return redirect('/')
            // ->withInput()
            // ->withErrors(['login_gagal'=>'These credentials does not match our records']);
            return $this->gagal();
         }

        // jika ga ada data user yang valid maka kembalikan lagi ke halaman login
        // pastikan kirim pesan error juga kalau login gagal ya



    }

    public function register(){
       // tampilkan view register
         return view('register');
    }

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
         return Redirect('/admin/access');
    }


}
