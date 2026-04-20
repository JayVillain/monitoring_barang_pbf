<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi manual
    protected $fillable = ['kode_barang', 'nama_barang', 'stok', 'deskripsi'];
    public function transactions() {
    return $this->hasMany(Transaction::class);
}
}