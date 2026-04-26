<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrediksiPanen extends Model
{
    protected $table = 'prediksi_panen';
    protected $primaryKey = 'id_prediksi';

    protected $fillable = [
        'hasil_prediksi',
        'tingkat_kepercayaan',
        'tanggal_prediksi',
        'id_monitoring',
        'id_tanam',
    ];

    // Relasi Many-to-One: Prediksi Panen terkait dengan satu Monitoring Data
    public function monitoringData()
    {
        return $this->belongsTo(MonitoringData::class, 'id_monitoring', 'id_monitoring');
    }

    // Relasi Many-to-One: Prediksi Panen terkait dengan satu Tanam
    public function tanam()
    {
        return $this->belongsTo(Tanam::class, 'id_tanam', 'id_tanam');
    }
}
