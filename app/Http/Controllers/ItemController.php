<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') return abort(403);
        return view('items.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') return abort(403);

        $request->validate([
            'kode_barang' => 'required|unique:items',
            'nama_barang' => 'required',
            'stok' => 'required|numeric|min:0',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function destroy(Item $item)
    {
        if (Auth::user()->role !== 'admin') return abort(403);
        
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }

    // Bagian edit, show, update bisa dikosongkan saja di dalam class ini 
    // atau dihapus jika tidak digunakan agar tidak bingung.
}