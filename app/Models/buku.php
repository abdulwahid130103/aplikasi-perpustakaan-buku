<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    public $table = "buku";

    protected $fillable = [
        'judul',
        'pengarang',
        'tahun_terbit',
        'stok',
        'kategori_id',
        'rak_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function detailBuku()
    {
        return $this->hasOne(DetailBuku::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
