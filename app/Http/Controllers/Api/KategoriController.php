<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index() {
        $cat = KategoriModel::all();
        return response()->json($cat,200);
    }
    
    function show($id) {
        $cat = KategoriModel::find($id);
        if(!$cat){
            return response()->json(['message' => 'Data kategori tidak ditemukan'], 404);
        }
        return response()->json($cat,200);;
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'kategori_kode'=>'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama'=>'required|string|max:100'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $cat = KategoriModel::create([
            'kategori_kode'=>$request->kategori_kode,
            'kategori_nama'=>$request->kategori_nama,
        ]);
        return response()->json($cat,201);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(),[
            'kategori_kode'=>'required|string|min:3|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'kategori_nama'=>'required|string|max:100'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $cat = KategoriModel::find($id);
        if(!$cat){
            return redirect('barang/kategori')->with('error','Data kategori tidak ditemukan');
        }
        $cat->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);
        return response()->json($cat,200);
    }
    
    public function destroy($id) {
        $check = KategoriModel::find($id);
        if(!$check){
            return response()->json(['message' => 'Data kategori tidak ditemukan'], 404);
        }
        try {
            KategoriModel::destroy($id);
            return response()->json(['message' => 'Data kategori berhasil dihapus'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000"){
                return response()->json([
                    'message' => 'Data kategori gagal dihapus',
                    'error' => 'Data kategori ini digunakan pada tabel lain'
                ], 500);
            }
            return response()->json([
                'message' => 'Data kategori gagal dihapus', 
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
