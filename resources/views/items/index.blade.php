@extends('layouts.app')

@section('content')
    <h1>Daftar Stok Barang</h1>

    @if(Auth::user()->role == 'admin')
        <a href="{{ route('items.create') }}" class="btn btn-blue">+ Tambah Jenis Barang Baru</a>
    @endif

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td><strong>{{ $item->stok }}</strong></td>
                <td>
                    <a href="{{ route('transactions.index', ['item_id' => $item->id]) }}" class="btn btn-green">Update Stok</a>

                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('items.edit', $item->id) }}" style="color: blue; margin-left: 10px;">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer;" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection