<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    use HasFactory;
    protected $table = 'pendataans';
    protected $fillable = [
        'id_petugas',
        'id_pelanggan',
        'nilai_meteran',
        'foto_meteran',
        'total_penggunaan',
        'total_harga',
        'status_pembayaran',
    ];
}

// class User extends Pendataan
// {

//     protected $table = 'pendataans';

//     public function pelanggan()
//     {
//         return $this->belongsTo('pendataans', 'id_pelanggan'); //c_id - customer id
//     }
//     public function petugas()
//     {
//         return $this->belongsTo('pendataans', 'id_petugas'); //s_id - staff id
//     }
// }