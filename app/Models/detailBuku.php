<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailBuku extends Model
{
    use HasFactory;
    public $table = "detail_buku";

    protected $fillable = [
        'buku_id',
        'isbn',
        'penerbit',
        'desc',
        'jumlah_halaman',
        'gambar'
    ];
    
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
