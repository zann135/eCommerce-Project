<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->level == '1') {
                return redirect()->intended('dashboard_tengkulak');
            } else if ($user->level == '2') {
                return redirect()->intended('dashboard_customer');
            }
        }
        return view('login.index');
    }

    public function login_form()
    {
        return view('login.loginform');
    }
    //
    public function proses_login(Request $request)
    {
        // buat validasi pada saat tombol login di klik
        // validas nya username & password wajib di isi 
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        // ambil data request username & password saja 
        $credential = $request->only('username', 'password');

        // cek jika data username dan password valid (sesuai) dengan data
        if (Auth::attempt($credential)) {
            // kalau berhasil simpan data user ya di variabel $user
            $user =  Auth::user();
            $request->session()->regenerate();
            // cek lagi jika level user admin maka arahkan ke halaman admin
            if ($user->level == '1') {
                return redirect()->intended('dashboard_tengkulak');
            } else if ($user->level == '2') {
                return redirect()->intended('customer');
            }
            // jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }

        // jika ga ada data user yang valid maka kembalikan lagi ke halaman login
        // pastikan kirim pesan error juga kalau login gagal
        return redirect('login_form')
            ->withInput()
            ->withErrors(['login_gagal' => 'These credentials does not match our records']);
    }

    public function register()
    {
        // tampilkan view register
        return view('register.index');
    }


    // aksi form register
    public function proses_register(Request $request)
    {
        //. kita buat validasi nih buat proses register
        // validasinya yaitu semua field wajib di isi
        // validasi username itu harus unique atau tidak boleh duplicate username ya
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        // kalau gagal kembali ke halaman register dengan munculkan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        // kalau berhasil isi level & hash passwordnya ya biar secure
        $request['level'] = 'user';
        $request['password'] = bcrypt($request->password);

        // masukkan semua data pada request ke table user
        User::create($request->all());

        // kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // kembali kan ke halaman login
        return Redirect('login');
    }

    // start test
    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'is_active' => 'dashboard',
            'pembelian' => $this->pembelian(),
            'belum_bayar' => $this->belum_bayar(),
            'menang_lelang' => $this->menang_lelang(),
            'kalah_lelang' => $this->kalah_lelang(),
            'history_lelang' => $this->history_lelang()->getData(),
            'history_menang_lelang' => $this->history_menang_lelang()->getData(),
        ]);
    }

    // dashboard
    public function pembelian()
    {
        return 120000;
    }

    public function belum_bayar()
    {
        return 120000;
    }

    public function menang_lelang()
    {
        return 5;
    }

    public function kalah_lelang()
    {
        return 5;
    }

    // ini nanti bentuknya list table
    public function history_lelang()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                [
                    'id_lelang' => 1,
                    'nama_cabai' => 'Cabai Merah',
                    'harga_awal' => 100000,
                    'harga_akhir' => 120000,
                    'status' => 'Menang',
                    'tanggal' => '2021-08-01',
                ],
                [
                    'id_lelang' => 2,
                    'nama_cabai' => 'Cabai Hijau',
                    'harga_awal' => 80000,
                    'harga_akhir' => 90000,
                    'status' => 'Kalah',
                    'tanggal' => '2021-08-02',
                ],
                [
                    'id_lelang' => 3,
                    'nama_cabai' => 'Cabai Rawit',
                    'harga_awal' => 70000,
                    'harga_akhir' => 85000,
                    'status' => 'Menang',
                    'tanggal' => '2021-08-03',
                ],
            ]
        ]);
    }

    // list table history menang lelang
    public function history_menang_lelang()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                [
                    'id_lelang' => 1,
                    'nama_cabai' => 'Cabai Merah',
                    'harga_awal' => 100000,
                    'harga_akhir' => 120000,
                    'status' => 'Menang',
                    'tanggal' => '2021-08-01',
                ],
                [
                    'id_lelang' => 3,
                    'nama_cabai' => 'Cabai Rawit',
                    'harga_awal' => 70000,
                    'harga_akhir' => 85000,
                    'status' => 'Menang',
                    'tanggal' => '2021-08-03',
                ],
            ]
        ]);
    }

    // lelang
    public function lelang()
    {
        return view('lelang', [
            'title' => 'Lelang',
            'is_active' => 'lelang',
            'list_lelang_tersedia' => $this->list_lelang_tersedia()->getData(),
        ]);
    }

    public function list_lelang_tersedia()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                [
                    'id_lelang' => 1,
                    'nama_lelang' => 'Lelang Jaya Jaya Jaya',
                    'waktu_mulai' => '2024-06-10 06:00:00',
                    'waktu_berakhir' => '2024-06-10 23:59:00',
                ],
                [
                    'id_lelang' => 2,
                    'nama_lelang' => 'Lelangku Menarik Perhatian',
                    'waktu_mulai' => '2024-06-10 10:30:00',
                    'waktu_berakhir' => '2024-06-10 11:30:00',
                ],
                [
                    'id_lelang' => 3,
                    'nama_lelang' => 'Lelang Saya Suka',
                    'waktu_mulai' => '2024-06-11 10:00:00',
                    'waktu_berakhir' => '2024-06-11 11:00:00',
                ],
                [
                    'id_lelang' => 4,
                    'nama_lelang' => 'Lelang Saya Suka',
                    'waktu_mulai' => '2024-06-01 10:00:00',
                    'waktu_berakhir' => '2024-06-01 11:00:00',
                ],
            ]
        ]);
    }

    // history_lelang
    public function history()
    {
        return view('history', [
            'title' => 'History Lelang',
            'is_active' => 'history',
            'history_lelang' => $this->history_lelang()->getData(),
            'list_lelang_tersedia' => $this->list_lelang_tersedia()->getData()
        ]);
    }

    // tambah lelang
    public function join_lelang()
    {
        return view('join_lelang', [
            'title' => 'Lelang',
            'is_active' => 'lelang',
        ]);
    }

    // end test
}
