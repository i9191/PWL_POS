@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($trs)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm w-50">
                    <tr>
                        <th>Kode Penjualan</th>
                        <td>{{ $trs->penjualan_kode }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $trs->pembeli }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>{{ $trs->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>{{$trs->penjualan_tanggal}}</td>
                    </tr>
                    <tr>
                        <th>Detail Item</th>
                        <td>
                            <ul class="list-group list-group-flush">
                                @foreach ($trs->transactDetails as $item)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-2">x<span class="quantity">{{ $item->jumlah }}</span></div>
                                        <div class="col-5">{{ $item->barang->barang_nama }}</div>
                                        <div class="col-5"><span class="harga_jual">{{ $item->barang->harga_jual }}</span></div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>{{$trs->transactDetails->sum('harga')}}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
