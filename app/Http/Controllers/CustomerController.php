<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // dashboard
    public function index(){
        return view('dashboard');
     }
     public function pembelian(){
        return 120000;
     }

     public function belum_bayar(){
        return 120000;
     }

     public function menang_lelang(){
        return 5;
     }

    public function kalah_lelang(){
        return 5;
    }

    // ini nanti bentuknya list table
    public function history_lelang(){
        return JsonResponse::create([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [[
                'id_lelang' => 1,
                'nama_cabai' => 'cabai merah',
                'harga_awal' => 100000,
                'harga_akhir' => 120000,
                'status' => 'menang',
                'tanggal' => '2021-08-01',
            ],
            [
                'id_lelang' => 2,
                'nama_cabai' => 'cabai hijau',
                'harga_awal' => 80000,
                'harga_akhir' => 90000,
                'status' => 'kalah',
                'tanggal' => '2021-08-02',
            ],
            [
                'id_lelang' => 3,
                'nama_cabai' => 'cabai rawit',
                'harga_awal' => 70000,
                'harga_akhir' => 85000,
                'status' => 'menang',
                'tanggal' => '2021-08-03',
            ],
            ]
        ]);
    }

    // list table history menang lelang
    public function history_menang_lelang(){
        return JsonResponse::create([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [[
                'id_lelang' => 1,
                'nama_cabai' => 'cabai merah',
                'harga_awal' => 100000,
                'harga_akhir' => 120000,
                'status' => 'menang',
                'tanggal' => '2021-08-01',
            ],
            [
                'id_lelang' => 3,
                'nama_cabai' => 'cabai rawit',
                'harga_awal' => 70000,
                'harga_akhir' => 85000,
                'status' => 'menang',
                'tanggal' => '2021-08-03',
            ],
            ]
        ]);
    }

     public function lelang(){
        return view('lelang');
    }

    public function list_lelang_tersedia(){
        return JsonResponse::create([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [[
                'id_lelang' => 1,
                'nama_cabai' => 'cabai merah',
                'harga_awal' => 100000,
                'stok' => 10,
                'foto_cabai' => 'cabai_merah.jpg',
            ],
            [
                'id_lelang' => 2,
                'nama_cabai' => 'cabai hijau',
                'harga_awal' => 80000,
                'stok' => 5,
                'foto_cabai' => 'cabai_hijau.jpg',
            ],
            [
                'id_lelang' => 3,
                'nama_cabai' => 'cabai rawit',
                'harga_awal' => 70000,
                'stok' => 8,
                'foto_cabai' => 'cabai_rawit.jpg',
            ],
            ]
        ]);
    }

    public function lelang_detail(){
        return view('lelang_detail');
    }

    public function history(){
        return view('history');
    }

    public function payment(){
        return view('payment');
    }

    public function invoice(){
        return view('invoice');
    }
}
