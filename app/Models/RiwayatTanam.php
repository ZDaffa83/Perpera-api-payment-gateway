<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatTanam extends Model
{
    protected $table = 'riwayat_tanam'; // default Laravel akan cari 'riwayat_tanams' kalau ini tidak ditulis
    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'tanggal',
        'kegiatan_perawatan',
        'catatan',
        'status',
    ];
}
