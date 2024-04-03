<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\LevelModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StokController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';
        $barang = BarangModel::all();
        $kategori = KategoriModel::all();
        $user = UserModel::all();
        $level = LevelModel::all();

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'user' => $user, 'level'=>$level, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $tableName = (new StokModel())->getTable();
        $items = StokModel::select('stok_id', $tableName.'.barang_id', $tableName.'.user_id', 'stok_tanggal', 'stok_jumlah')->with('barang.kategori')->with('user.level');
        if($request->kategori_id){
            $items->whereHas('barang.kategori', function ($query) use ($request) {
                $query->where('kategori_id', $request->kategori_id);
            });
        }
        if($request->level_id){
            $items->whereHas('user.level', function ($query) use ($request) {
                $query->where('level_id', $request->level_id);
            });
        }
        return DataTables::of($items)
            ->addIndexColumn() 
            ->addColumn('aksi', function ($item) { 
                $btn = '<a href="' . url('stok/' . $item->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('stok/' . $item->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('stok/' . $item->stok_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    function show(string $id) {
        $stok = StokModel::with('barang')->with('user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok';
        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();
        $activeMenu = 'stok';

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user'=>$user, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            'barang_id'=>'required|integer',
            'user_id'=>'required|integer',
            'stok_tanggal'=>'required|date_format:Y-m-d',
            'stok_jumlah'=>'required|integer'
        ]);
        StokModel::create([
            'barang_id'=> $request->barang_id,
            'user_id'=> $request->user_id,
            'stok_tanggal'=> $request->stok_tanggal,
            'stok_jumlah'=> $request->stok_jumlah,
        ]);
        return redirect('stok')->with('success','Data stok berhasil disimpan');
    }
    public function edit(string $id) {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok'
        ];

        $activeMenu = 'stok';
        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'barang' => $barang, 'user'=>$user, 'activeMenu' => $activeMenu]);
    }
    public function update(string $id, Request $request) {
        $request->validate([
            'barang_id'=>'required|integer',
            'user_id'=>'required|integer',
            'stok_tanggal'=>'required|date_format:Y-m-d',
            'stok_jumlah'=>'required|integer'
        ]);
        StokModel::find($id)->update([
            'barang_id'=> $request->barang_id,
            'user_id'=> $request->user_id,
            'stok_tanggal'=> $request->stok_tanggal,
            'stok_jumlah'=> $request->stok_jumlah,
        ]);
        return redirect('/stok')->with('success','Data stok berhasil diubah');
    }
    public function destroy(string $id) {
        $check = StokModel::find($id);
        if(!$check){
            return redirect('/stok')->with('error','Data stok tidak ditemukan');
        }
        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success','Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error','Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
