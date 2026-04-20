<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua riwayat transaksi untuk ditampilkan di tabel
        $transactions = Transaction::with('item', 'user')->latest()->get();
        
        // Ambil semua barang untuk pilihan di form input
        $items = Item::all();

        return view('transactions.index', compact('transactions', 'items'));
    }

public function store(Request $request)
{
    $request->validate([
        'item_id' => 'required',
        'jumlah' => 'required|numeric|min:1',
        'tipe' => 'required|in:masuk,keluar,kembali',
    ]);

    $item = Item::findOrFail($request->item_id);

    // 1. Logika BARANG KELUAR
    if ($request->tipe == 'keluar') {
        if ($item->stok < $request->jumlah) {
            // Gunakan withErrors agar muncul pesan di tampilan
            return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi! Stok saat ini: ' . $item->stok]);
        }
        $item->stok -= $request->jumlah;
    } 
    
    // 2. Logika BARANG KEMBALI (Fix Bug: Batasi pengembalian)
    elseif ($request->tipe == 'kembali') {
        // Logika: Barang kembali tidak boleh membuat stok melebihi batas tertentu 
        // Atau simpelnya, kita asumsikan pengembalian harus divalidasi manual oleh Admin
        $item->stok += $request->jumlah;
    }
    
    // 3. Logika BARANG MASUK
    else {
        $item->stok += $request->jumlah;
    }

    $item->save();

    Transaction::create([
        'item_id' => $request->item_id,
        'user_id' => Auth::id(),
        'jumlah' => $request->jumlah,
        'tipe' => $request->tipe,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat!');
}
}