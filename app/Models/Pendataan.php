<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_petugas',
        'id_pelanggan',
        'nama_pelanggan',
        'nilai_meteran',
        'foto_meteran',
        'total_harga',
        'status_pembayaran',
    ];
}
