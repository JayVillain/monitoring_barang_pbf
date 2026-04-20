@extends('layouts.app')

@section('content')
    <h1>Tambah Barang Baru</h1>
    <a href="{{ route('items.index') }}"> Kembali</a>

    <form action="{{ route('items.store') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <div style="margin-bottom: 10px;">
            <label>Kode Barang:</label><br>
            <input type="text" name="kode_barang" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Nama Barang:</label><br>
            <input type="text" name="nama_barang" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Stok Awal:</label><br>
            <input type="number" name="stok" value="0" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi"></textarea>
        </div>
        <button type="submit" class="btn btn-blue">Simpan Barang</button>
    </form>
@endsection