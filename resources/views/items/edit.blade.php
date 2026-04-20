@extends('layouts.app')

@section('content')
    <h1>Edit Data Barang</h1>
    <a href="{{ route('items.index') }}"> Kembali</a>

    <form action="{{ route('items.update', $item->id) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('PUT') <div style="margin-bottom: 10px;">
            <label>Kode Barang:</label><br>
            <input type="text" name="kode_barang" value="{{ $item->kode_barang }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Nama Barang:</label><br>
            <input type="text" name="nama_barang" value="{{ $item->nama_barang }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Stok Saat Ini:</label><br>
            <input type="number" name="stok" value="{{ $item->stok }}" required min="0">
            <p style="font-size: 12px; color: gray;">*Hati-hati mengubah stok secara manual di sini.</p>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi">{{ $item->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-blue">Update Data</button>
    </form>
@endsection