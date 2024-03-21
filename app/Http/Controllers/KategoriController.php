<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }

    public function create() {
        return view('kategori.create');
    }

    public function store(Request $request) {
        KategoriModel::create([
            'kategori_kode'=>$request->kodeKategori,
            'kategori_nama'=>$request->namaKategori,
        ]);
        return redirect('/kategori');
    }
    public function edit($id) {
        $kat = KategoriModel::find($id);
        return view('kategori.edit', ['kategori' => $kat]);
    }
    public function update($id, Request $request) {
        $kat = KategoriModel::find($id);
        $kat->kategori_kode=$request->kodeKategori;
        $kat->kategori_nama=$request->namaKategori;
        $kat->save();
        return redirect('/kategori');
    }
    public function delete($id) {
        $user = KategoriModel::find($id);
        $user->delete();
        return redirect('/kategori');
    }
}
