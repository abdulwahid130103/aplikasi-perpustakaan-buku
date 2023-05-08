<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    public $table = "kategori";

    protected $fillable = [
        'nama'
    ];

    public function buku(){
        return $this->hasMany(buku::class);
    }
}
