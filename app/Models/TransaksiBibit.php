<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiBibit extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'nama_pembeli',
        'jenis_bibit',
        'jumlah',
        'total_harga',
        'status',
        'snap_token',
    ];
}