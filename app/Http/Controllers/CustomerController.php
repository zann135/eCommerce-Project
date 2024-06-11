<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // dashboard
    public function dashboard()
    {
        try {
            $user = Auth::user();
            if ($user->level != '2') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('customer.dashboard', [
            'title' => 'Dashboard',
            'is_active' => 'dashboard',
            'user' => $user,
            'pembelian' => $this->pembelian(),
            'belum_bayar' => $this->belum_bayar(),
            'menang_lelang' => $this->menang_lelang(),
            'kalah_lelang' => $this->kalah_lelang(),
            'history_lelang' => $this->history_lelang()->getData(),
            'history_menang_lelang' => $this->history_menang_lelang()->getData(),
        ]);
    }
    public function pembelian()
    {
        $id_customer = Auth::user()->id;
        $totalPenjualan = DB::table('lelang')
            ->where('id_customer', $id_customer)
            ->where('status_lelang', 3)
            ->sum('harga_akhir');

        return (int) $totalPenjualan;
    }

    public function belum_bayar()
    {
        $id_customer = Auth::user()->id;
        $totalBelumDibayar = DB::table('lelang')
            ->where('id_customer', $id_customer)
            ->where('status_lelang', 2)
            ->sum('harga_akhir');

        return (int) $totalBelumDibayar;
    }

    public function menang_lelang()
    {
        $id_customer = Auth::user()->id;
        $totalLelangBerhasil = DB::table('lelang')
            ->where('id_tengkulak', $id_customer)
            ->where('status_lelang', 3)
            ->count();

        return (int) $totalLelangBerhasil;
    }

    public function kalah_lelang()
    {
        $totalLelang = DB::table('lelang')
            ->where('status_lelang', 3)
            ->count();

        return (int) ($totalLelang - $this->menang_lelang());
    }

    // ini nanti bentuknya list table
    public function history_lelang()
    {
        $id_customer = Auth::user()->id;
        $historyLelang = DB::table('lelang')
            ->where('id_customer', $id_customer)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $historyLelang,
        ]);
    }

    // list table history menang lelang
    public function history_menang_lelang()
    {
        $id_customer = Auth::user()->id;
        $historyPemenangLelang = DB::table('lelang')
            ->where('id_customer', $id_customer)
            ->where('status_lelang', 3)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $historyPemenangLelang,
        ]);
    }

    public function list_lelang_customer()
    {
        try {
            $user = Auth::user();
            if ($user->level != '2') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('customer.lelang', [
            'title' => 'List Lelang',
            'is_active' => 'list_lelang',
            'list_lelang_tersedia' => $this->get_list_lelang()->getData(),
        ]);
    }

    public function get_list_lelang()
    {
        $id_customer = Auth::user()->id;
        $listLelang = DB::table('lelang')
            ->where('id_customer', $id_customer)
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

    public function history_lelang_view()
    {
        try {
            $user = Auth::user();
            if ($user->level != '2') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('customer/history', [
            'title' => 'List Lelang',
            'is_active' => 'list_lelang',
            'history_lelang' => $this->history_lelang()->getData(),
        ]);
    }

    public function update_lelang(Request $request)
    {
        $id_lelang = $request->id_lelang;
        $harga_akhir = $request->harga_akhir;
        $id_customer = Auth::user()->id;

        $updateLelang = DB::table('lelang')
            ->where('id_lelang', $id_lelang)
            ->update([
                'harga_akhir' => $harga_akhir,
                'id_customer' => $id_customer,
            ]);

        if ($updateLelang) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data gagal diupdate',
            ]);
        }
    }

    public function payment()
    {
        try {
            $user = Auth::user();
            if ($user->level != '2') {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/');
        }
        return view('customer/payment', [
            'title' => 'List Lelang',
            'is_active' => 'list_lelang',
            'history_lelang' => $this->get_active_payment()->getData(),
        ]);
    }

    public function get_active_payment()
    {
        $id_customer = Auth::user()->id;
        $listLelang = DB::table('lelang')
            ->where('id_customer', $id_customer)
            ->where('status_lelang', 2)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $listLelang,
        ]);
    }

    #generate manual pdf invoice
    public function generate_invoice($id_lelang)
    {
        $lelang = DB::table('lelang')
            ->where('id_lelang', $id_lelang)
            ->first();
    }
}
