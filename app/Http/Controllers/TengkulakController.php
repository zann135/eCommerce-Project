<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TengkulakController extends Controller
{
    public function dashboard()
    {
        try {
            $user = Auth::user();
            if ($user->level != '1') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('tengkulak.dashboard', [
            'title' => 'Dashboard',
            'is_active' => 'dashboard',
            'user' => $user,
            'pembelian' => $this->penjualan(),
            'belum_bayar' => $this->belum_dibayar(),
            'menang_lelang' => $this->lelang_berhasil(),
            'kalah_lelang' => $this->jumlah_customer(),
            'history_lelang' => $this->history_lelang()->getData(),
            'history_menang_lelang' => $this->history_pemenang_lelang()->getData(),
        ]);
    }
    public function penjualan()
    {
        $id_tengkulak = Auth::user()->id;
        $totalPenjualan = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->where('status_lelang', 3)
        ->sum('harga_akhir');

        return (int) $totalPenjualan;
    }
    public function belum_dibayar()
    {
        $id_tengkulak = Auth::user()->id;
        $totalBelumDibayar = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->where('status_lelang', 2)
        ->sum('harga_akhir');

        return (int) $totalBelumDibayar;
    }
    public function lelang_berhasil()
    {
        $id_tengkulak = Auth::user()->id;
        $totalLelangBerhasil = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->where('status_lelang', 3)
        ->count();

        return (int) $totalLelangBerhasil;
    }
    public function jumlah_customer()
    {
        $id_tengkulak = Auth::user()->id;
        $totalCustomer = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->where('status_lelang', 2)
        ->count();

        return (int) $totalCustomer;
    }
    public function history_lelang()
    {
        $id_tengkulak = Auth::user()->id;
        $historyLelang = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->get();


        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $historyLelang,
        ]);
    }
    public function history_pemenang_lelang()
    {
        $id_tengkulak = Auth::user()->id;
        $historyPemenangLelang = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->where('status_lelang', 3)
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $historyPemenangLelang,
        ]);
    }


    public function list_lelang()
    {
        try {
            $user = Auth::user();
            if ($user->level != '1') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('tengkulak/lelang', [
            'title' => 'List Lelang',
            'is_active' => 'list_lelang',
            'list_lelang_tersedia' => $this->get_list_lelang()->getData(),
        ]);
    }
    # get list lelang berdasarkan id_tengkulak dan status lelang belum dimulai dan dimulai, urutkan dari status lelang dimulai lalu waktu lelang yang terdekat
    public function get_list_lelang()
    {
        $id_tengkulak = Auth::user()->id;
        $listLelang = DB::table('lelang')
        ->where('id_tengkulak', $id_tengkulak)
        ->where('status_lelang', 0)
        ->orWhere('status_lelang', 1)
        ->orderBy('status_lelang', 'asc')
        ->orderBy('tanggal_mulai', 'asc')
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $listLelang,
        ]);
    }


    public function history_lelang_view(){
        try {
            $user = Auth::user();
            if ($user->level != '1') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('tengkulak/history', [
            'title' => 'List Lelang',
            'is_active' => 'list_lelang',
            'history_lelang' => $this->history_lelang()->getData(),
        ]);
    }


    public function tambah_lelang(Request $request)
    {
        $id_tengkulak = Auth::user()->id;
        $nama_lelang = $request->nama_lelang;
        $waktu_mulai = $request->waktu_mulai;
        $waktu_selesai = $request->waktu_selesai;
        $harga_awal = $request->harga_awal;
        $deskripsi = $request->deskripsi;

        $tambahLelang = DB::table('lelang')->insert([
            'id_tengkulak' => $id_tengkulak,
            'nama_lelang' => $nama_lelang,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'harga_awal' => $harga_awal,
            'deskripsi' => $deskripsi,
            'status_lelang' => 0,
            'tanggal_mulai' => date('Y-m-d H:i:s'),
            'tanggal_selesai' => date('Y-m-d H:i:s'),
        ]);

        if ($tambahLelang) {
            return redirect()->back()->with('success', 'Lelang berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Lelang gagal ditambahkan');
        }
    }

    public function edit_lelang($id_lelang)
    {
        $lelang = DB::table('lelang')->where('id_lelang', $id_lelang)->first();
        return view('tengkulak/edit_lelang', [
            'title' => 'Edit Lelang',
            'is_active' => 'list_lelang',
            'lelang' => $lelang,
        ]);
    }
}
