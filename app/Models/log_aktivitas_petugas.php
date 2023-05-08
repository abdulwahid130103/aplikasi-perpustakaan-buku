<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_aktivitas_petugas extends Model
{
    use HasFactory;

    public $table = "log_aktivitas_petugas";

    protected $fillable = [
        'user_id',
        'aktivitas',
        'waktu'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
