<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarisBibit extends Model
{
    protected $fillable = ['nama_bibit', 'stok_tersedia', 'lokasi_gudang'];
}