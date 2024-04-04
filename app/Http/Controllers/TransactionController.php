<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\LevelModel;
use App\Models\TransactDetailsModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan';
        $user = UserModel::all();
        $level = LevelModel::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level'=>$level, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request) {
        $tableName = (new TransactionModel())->getTable();
        $items = TransactionModel::select('penjualan_id', $tableName.'.user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')->with('user.level')->withSum('transactDetails','harga');
        if($request->level_id){
            $items->whereHas('user.level', function ($query) use ($request) {
                $query->where('level_id', $request->level_id);
            });
        }
        return DataTables::of($items)
            ->addIndexColumn() 
            ->addColumn('aksi', function ($item) { 
                $btn = '<a href="' . url('penjualan/' . $item->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('penjualan/' . $item->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('penjualan/' . $item->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    function show(string $id) {
        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];
        $activeMenu = 'penjualan';
        $trs = TransactionModel::find($id);
        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'trs' => $trs,
            'activeMenu' => $activeMenu]);
    }
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi Penjualan',
            'list' => ['Home', 'Transaksi', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah transaksi baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user'=>$user, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|min:3|unique:t_penjualan,penjualan_kode',
            'pembeli' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date_format:Y-m-d H:i:s',
            // 'alldata'=>'required',
        ]);

        $penjualan = new TransactionModel();
        $penjualan->user_id = $request->user_id;
        $penjualan->penjualan_kode = $request->penjualan_kode;
        $penjualan->pembeli = $request->pembeli;
        $penjualan->penjualan_tanggal = $request->penjualan_tanggal;
        $penjualan->save();

        // Loop items penjualan detail
        $allData = json_decode($request->allData, true);
        foreach ($allData as $data) {
            $barangId = $data['barang_id'];
            $quantity = $data['quantity'];

            if ($quantity > 0) {
                // $barang = BarangModel::find($barangId);
                $detailP = new TransactDetailsModel();
                $detailP->penjualan_id = $penjualan->penjualan_id;
                $detailP->barang_id = $barangId;
                $detailP->jumlah = $quantity;
                $detailP->harga = $quantity * $data['harga_jual'];
                $detailP->save();
            }
        }

        // Redirect to a success page or return a response
        return redirect('penjualan')->with('success', 'Data transaksi berhasil disimpan.');
    }
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Transaksi Penjualan',
            'list' => ['Home', 'Transaksi', 'Penjualan', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit transaksi penjualan'
        ];
        $transaction = TransactionModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();
        $activeMenu = 'penjualan';
        
        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaction' => $transaction, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|min:3|unique:t_penjualan,penjualan_kode,'.$id.',penjualan_id',
            'pembeli' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date_format:Y-m-d H:i:s',
            // 'alldata'=>'required',
        ]);

        $penjualan = TransactionModel::find($id);
        $penjualan->user_id = $request->user_id;
        $penjualan->penjualan_kode = $request->penjualan_kode;
        $penjualan->pembeli = $request->pembeli;
        $penjualan->penjualan_tanggal = $request->penjualan_tanggal;
        $penjualan->save();

        // Assuming allData contains the details of the penjualan items
        $allData = json_decode($request->allData, true);
        foreach ($allData as $data) {
            $barangId = $data['barang_id'];
            $quantity = $data['quantity'];

            if ($quantity > 0) {
                $detailP = TransactDetailsModel::where('penjualan_id', $penjualan->penjualan_id)
                                                ->where('barang_id', $barangId)
                                                ->first();
                if ($detailP) {
                    $detailP->jumlah = $quantity;
                    $detailP->harga = $quantity * $data['harga_jual'];
                    $detailP->save();
                } else {
                    $newDetailP = new TransactDetailsModel();
                    $newDetailP->penjualan_id = $penjualan->penjualan_id;
                    $newDetailP->barang_id = $barangId;
                    $newDetailP->jumlah = $quantity;
                    $newDetailP->harga = $quantity * $data['harga_jual'];
                    $newDetailP->save();
                }
            }
        }

        // Redirect back with a success message
        return redirect('penjualan')->with('success', 'Transaksi berhasil diubah.');
    }
    public function destroy(string $id) {
        $check = TransactionModel::find($id);
        if(!$check){
            return redirect('/penjualan')->with('error','Data penjualan tidak ditemukan');
        }
        try {
            TransactionModel::destroy($id);
            return redirect('/penjualan')->with('success','Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error','Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
