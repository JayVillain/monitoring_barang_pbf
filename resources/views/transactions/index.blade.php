@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 20px;">
        <h1>Monitoring Keluar Masuk Barang</h1>
        <p>Gunakan form di bawah ini untuk mencatat setiap pergerakan stok barang.</p>
    </div>

    @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;">
            <strong>Gagal!</strong> {{ $errors->first() }}
        </div>
    @endif

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; padding: 25px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-top: 0;">Input Transaksi Baru</h3>
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                
                <div style="flex: 1; min-width: 200px;">
                    <label style="display:block; margin-bottom:5px;">Pilih Barang:</label>
                    <select name="item_id" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                        <option value="">-- Pilih Barang --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_barang }} (Stok Saat Ini: {{ $item->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="flex: 1; min-width: 150px;">
                    <label style="display:block; margin-bottom:5px;">Tipe:</label>
                    <select name="tipe" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                        <option value="masuk">Barang Masuk</option>
                        <option value="keluar">Barang Keluar</option>
                        <option value="kembali">Barang Kembali</option>
                    </select>
                </div>

                <div style="flex: 0.5; min-width: 100px;">
                    <label style="display:block; margin-bottom:5px;">Jumlah:</label>
                    <input type="number" name="jumlah" placeholder="0" required min="1" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                </div>

                <div style="flex: 1.5; min-width: 200px;">
                    <label style="display:block; margin-bottom:5px;">Keterangan:</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Barang dari Supplier A" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                </div>

                <div style="flex: 0.5; display: flex; align-items: flex-end;">
                    <button type="submit" class="btn btn-blue" style="width: 100%; height: 38px; font-weight: bold;">Simpan</button>
                </div>

            </div>
        </form>
    </div>

    <hr style="margin: 40px 0; border: 0; border-top: 1px solid #eee;">

    <h3 style="margin-bottom: 15px;">Riwayat Transaksi (Log Monitoring)</h3>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Waktu & Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Operator</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trans)
                <tr>
                    <td>{{ $trans->created_at->format('d M Y, H:i') }}</td>
                    <td><strong>{{ $trans->item->nama_barang }}</strong></td>
                    <td>
                        @if($trans->tipe == 'masuk')
                            <span style="background: #e6fffa; color: #2c7a7b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">MASUK</span>
                        @elseif($trans->tipe == 'keluar')
                            <span style="background: #fff5f5; color: #c53030; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">KELUAR</span>
                        @else
                            <span style="background: #fffaf0; color: #9c4221; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">KEMBALI</span>
                        @endif
                    </td>
                    <td>{{ $trans->jumlah }}</td>
                    <td>{{ $trans->user->name }}</td>
                    <td><small>{{ $trans->keterangan ?? '-' }}</small></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #888;">Belum ada data transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection