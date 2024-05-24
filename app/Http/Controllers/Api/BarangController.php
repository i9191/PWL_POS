<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index() {
        $barang = BarangModel::with('kategori')->get();
        return response()->json($barang,200);
    }

    function show($id) {
        $barang = BarangModel::with('kategori')->find($id);
        if(!$barang){
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }
        return response()->json($barang,200);
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'barang_kode'=>'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'=>'required|string|max:100',
            'harga_beli'=>'required|integer|min:5',
            'harga_jual'=>'required|integer|min:5',
            'kategori_id'=>'required|integer|exists:m_kategori,kategori_id',
            'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
            'gambar' => $request->gambar->hashName(),
        ]);
        return response()->json($barang,201);
    }
    
    public function update($id, Request $request) {
        $validator = Validator::make($request->all(),[
            'barang_kode'=>'required|string|min:3|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama'=>'required|string|max:100',
            'harga_beli'=>'required|integer|min:5',
            'harga_jual'=>'required|integer|min:5',
            'kategori_id'=>'required|integer|exists:m_kategori,kategori_id'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $barang = BarangModel::find($id);
        if(!$barang){
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }
        $barang->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);
        return response()->json($barang,200);
    }
    public function destroy($id) {
        $check = BarangModel::find($id);
        if(!$check){
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }
        try {
            BarangModel::destroy($id);
            return response()->json(['message' => 'Data barang berhasil dihapus'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return response()->json([
                    'message' => 'Data barang gagal dihapus',
                    'error' => 'Data barang ini digunakan pada tabel lain'
                ], 500);
            }
            return response()->json([
                'message' => 'Data barang gagal dihapus',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
