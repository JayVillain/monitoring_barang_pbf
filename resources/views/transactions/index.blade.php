@extends('layouts.app')

@section('content')
    <h1>Monitoring Keluar Masuk Barang</h1>

    <div style="background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h3>Input Transaksi Baru</h3>
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <select name="item_id" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_barang }} (Stok: {{ $item->stok }})</option>
                @endforeach
            </select>

            <select name="tipe" required>
                <option value="masuk">Barang Masuk</option>
                <option value="keluar">Barang Keluar</option>
                <option value="kembali">Barang Kembali</option>
            </select>

            <input type="number" name="jumlah" placeholder="Jumlah" required min="1">
            <input type="text" name="keterangan" placeholder="Keterangan (Opsional)">
            
            <button type="submit" class="btn btn-blue">Simpan Transaksi</button>
        </form>
    </div>

    <hr>

    <h3>Riwayat Transaksi</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Petugas</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trans)
            <tr>
                <td>{{ $trans->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $trans->item->nama_barang }}</td>
                <td>
                    <span style="color: {{ $trans->tipe == 'masuk' ? 'green' : ($trans->tipe == 'keluar' ? 'red' : 'orange') }}">
                        {{ strtoupper($trans->tipe) }}
                    </span>
                </td>
                <td>{{ $trans->jumlah }}</td>
                <td>{{ $trans->user->name }}</td>
                <td>{{ $trans->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection