@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('penjualan/'.$transaction->penjualan_id) }}" class="form-horizontal">
                @csrf
                {!! method_field('PUT') !!}
                <div class="form-group row pl-5 pr-5">
                    <div class="col">
                        <table id="barangTable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $item->barang_id }}</td>
                                        <td>{{ $item->barang_nama }}</td>
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>
                                            @php
                                                $qty = 0;
                                                foreach ($transaction->transactDetails as $detail) {
                                                    if ($detail->barang_id == $item->barang_id) {
                                                        $qty = $detail->jumlah;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <input type="number" class="form-control quantity-input" data-barang_id="{{ $item->barang_id }}" name="quantity[]" value="{{$qty}}">
                                            <input type="hidden" name="barang_id[]" value="{{ $item->barang_id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6 mt-5">
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">User</label>
                            <div class="col-10">
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <option value="">- Pilih User -</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->user_id }}" @if($item->user_id == $transaction->user_id) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Penjualan Kode</label>
                            <div class="col-10">
                                <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ $transaction->penjualan_kode }}" required>
                                @error('penjualan_kode')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Pembeli</label>
                            <div class="col-10">
                                <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ $transaction->pembeli }}" required>
                                @error('pembeli')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Tanggal</label>
                            <div class="col-10">
                                <div class="input-group date" id="penjualan_tanggal_input" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#penjualan_tanggal_input" id="penjualan_tanggal" name="penjualan_tanggal"
                                        value="{{ old('penjualan_tanggal') }}" required/>
                                    <div class="input-group-append" data-target="#penjualan_tanggal_input" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('penjualan_tanggal')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-2 control-label col-form-label"></label>
                            <div class="col-10">
                                <button type="button" class="btn btn-primary btn-sm" id="submitItemsBtn">Update</button>
                                <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label class="col control-label col-form-label">List Barang</label>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <ul id="barangList" class="list-group list-group-flush">
                                    @foreach ($barang as $item)
                                    @php
                                        $qty = 0;
                                        foreach ($transaction->transactDetails as $detail) {
                                            if ($detail->barang_id == $item->barang_id) {
                                                $qty = $detail->jumlah;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <li id="listItem_{{ $item->barang_id }}" class="list-group-item {{($qty==0) ? 'd-none':''}}">
                                        <div class="row">
                                            <div class="col-2">x<span class="quantity">{{$qty}}</span></div>
                                            <div class="col-5">{{ $item->barang_nama }}</div>
                                            <div class="col-5"><span class="harga_jual">{{ $item->harga_jual }}</span></div>
                                        </div>
                                    </li>
                                    @endforeach
                                    <li id="total_transaksi" class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">Total</div>
                                            <div class="col-5"><span class="sum_transaksi">{{$transaction->transactDetails->sum('harga')}}</span></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function(){
        $('#penjualan_tanggal_input').datetimepicker({ 
            icons: { time: 'far fa-clock' },
            sideBySide: true,
            defaultDate: new Date('{{ $transaction->penjualan_tanggal }}'),
            allowInputToggle: true,
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#barangTable').DataTable({
            "paging": true,
            "pageLength": 4,
            "lengthMenu": [4, 8, 10],
            "searching": true
        });
        // Quantity input validation
        $('#barangTable').on('input', '.quantity-input', function() {
            if ($(this).val() <= 0) {
                $(this).val(0);
            } else {
                if ($(this).val().charAt(0) == '0') {
                    $(this).val($(this).val().substring(1));
                }
            }
            let barangId = $(this).data('barang_id');
            let quantity = $(this).val();
            updateQuantityList(barangId, quantity);
            calculateTotal();
        });
        function updateQuantityList(barangId, quantity) {
            // Update the quantity in the list view
            $('#listItem_' + barangId + ' .quantity').text(quantity);
            // Show/hide list items based on quantity
            if (quantity > 0) {
                $('#listItem_' + barangId).removeClass('d-none');
            } else {
                $('#listItem_' + barangId).addClass('d-none');
            }
        }
        function calculateTotal() {
            var total = 0;
            $('#barangList li').each(function(index) {
                var quantity = parseInt($(this).find('.quantity').text());
                if (quantity > 0) {
                    var harga = parseFloat($(this).find('.harga_jual').text());
                    total += quantity * harga;
                }
            });
            if (total > 0) {
                $('#total_transaksi').removeClass('d-none');
            } else {
                $('#total_transaksi').addClass('d-none');
            }
            $('.sum_transaksi').text(total);
        }
        $('#submitItemsBtn').on('click', function() {
            var allData = [];
            $('#barangList li').each(function() {
                var quantity = parseInt($(this).find('.quantity').text());
                var barangId = $(this).attr('id').split('_')[1];
                var barangNama = $(this).find('.col-5').text();
                var hargaJual = parseFloat($(this).find('.harga_jual').text());
                allData.push({
                    barang_id: barangId,
                    quantity: quantity,
                    barang_nama: barangNama,
                    harga_jual: hargaJual
                });
            });
            console.log(allData);
            // Append all data to the form
            var form = $('<form>', {
                'method': 'POST',
                'action': "{{ url('penjualan/'.$transaction->penjualan_id) }}",
                'class': 'd-none'
            });
            form.append($('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': '{{ csrf_token() }}'
            }));
            form.append($('<input>', {
                'type': 'hidden',
                'name': '_method',
                'value': 'PUT'
            }));
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'allData',
                'value': JSON.stringify(allData)
            }));
            // Create input fields for data
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'user_id',
                'value': $('#user_id').val()
            }));
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'penjualan_kode',
                'value': $('#penjualan_kode').val()
            }));
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'pembeli',
                'value': $('#pembeli').val()
            }));
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'penjualan_tanggal',
                'value': $('#penjualan_tanggal').val()
            }));
            $('body').append(form);
            form.submit();
        });
    });
</script>
@endpush