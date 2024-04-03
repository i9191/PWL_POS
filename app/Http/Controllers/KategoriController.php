<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori Barang',
            'list' => ['Home', 'Barang', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';
        // $level = LevelModel::all();

        return view('barang.kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
        // return $dataTable->render('kategori.index');
    }
    public function list(Request $request)
    {
        $cats = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');
        return DataTables::of($cats)
            ->addIndexColumn() 
            ->addColumn('aksi', function ($cat) { 
                $btn = '<a href="' . url('/barang/kategori/' . $cat->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/kategori/' . $cat->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/kategori/' . $cat->kategori_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) 
            ->make(true);
    }
    function show(string $id) {
        $cat = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Barang', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';
        return view('barang.kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $cat, 'activeMenu' => $activeMenu]);
    }
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Barang', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('barang.kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            'kategori_kode'=>'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama'=>'required|string|max:100'
        ]);
        KategoriModel::create([
            'kategori_kode'=>$request->kategori_kode,
            'kategori_nama'=>$request->kategori_nama,
        ]);
        return redirect('barang/kategori')->with('success','Data kategori berhasil disimpan');
    }
    public function edit(string $id) {
        $kat = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Barang', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';
        return view('barang.kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kat, 'activeMenu' => $activeMenu]);
    }
    public function update(string $id, Request $request) {
        $request->validate([
            'kategori_kode'=>'required|string|min:3|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'kategori_nama'=>'required|string|max:100'
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);
        return redirect('barang/kategori')->with('success','Data kategori berhasil diubah');
    }
    public function destroy(string $id) {
        $check = KategoriModel::find($id);
        if(!$check){
            return redirect('barang/kategori')->with('error','Data kategori tidak ditemukan');
        }
        try {
            KategoriModel::destroy($id);
            return redirect('barang/kategori')->with('success','Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('barang/kategori')->with('error','Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
