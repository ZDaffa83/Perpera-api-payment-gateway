<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerawatanHPT extends Model
{
    protected $table = 'perawatan_hpt';
    protected $primaryKey = 'id_perawatan';
    protected $fillable = ['tanggal', 'kegiatan', 'catatan', 'status'];
    protected $casts = [
        'tanggal' => 'date',
        'status' => 'boolean',
    ];
}