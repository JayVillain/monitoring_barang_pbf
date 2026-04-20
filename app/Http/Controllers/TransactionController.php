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

        // LOGIKA UPDATE STOK
        if ($request->tipe == 'masuk' || $request->tipe == 'kembali') {
            $item->stok += $request->jumlah;
        } elseif ($request->tipe == 'keluar') {
            // Cek apakah stok cukup
            if ($item->stok < $request->jumlah) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi untuk barang keluar!']);
            }
            $item->stok -= $request->jumlah;
        }

        // Simpan perubahan stok barang
        $item->save();

        // Catat riwayat transaksi
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