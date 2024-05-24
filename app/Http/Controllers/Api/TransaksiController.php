<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() {
        $trs = TransactionModel::with('transactDetails.barang')->get();
        return response()->json($trs,200);
    }

    function show($id) {
        $trs = TransactionModel::with('transactDetails.barang')->find($id);
        if(!$trs){
            return response()->json(['message' => 'Data penjualan tidak ditemukan'], 404);
        }
        return response()->json($trs,200);
    }
}
