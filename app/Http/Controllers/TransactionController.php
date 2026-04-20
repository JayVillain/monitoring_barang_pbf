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

    // 1. LOGIKA BARANG KELUAR
    if ($request->tipe == 'keluar') {
        if ($item->stok < $request->jumlah) {
            return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi! Stok saat ini: ' . $item->stok]);
        }
        $item->stok -= $request->jumlah;
    } 
    
    // 2. LOGIKA BARANG KEMBALI (FIX BUG)
    elseif ($request->tipe == 'kembali') {
        // Hitung total barang yang pernah keluar
        $totalKeluar = Transaction::where('item_id', $item->id)->where('tipe', 'keluar')->sum('jumlah');
        
        // Hitung total barang yang sudah pernah dikembalikan sebelumnya
        $totalSudahKembali = Transaction::where('item_id', $item->id)->where('tipe', 'kembali')->sum('jumlah');

        // Sisa barang yang masih di luar dan bisa dikembalikan
        $maksimalKembali = $totalKeluar - $totalSudahKembali;

        if ($request->jumlah > $maksimalKembali) {
            return redirect()->back()->withErrors(['error' => 'Jumlah pengembalian tidak valid! Maksimal barang yang bisa kembali: ' . $maksimalKembali]);
        }

        $item->stok += $request->jumlah;
    }
    
    // 3. LOGIKA BARANG MASUK
    else {
        $item->stok += $request->jumlah;
    }

    // Simpan perubahan stok ke tabel items
    $item->save();

    // Catat riwayat ke tabel transactions
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