<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_rumput',
        'tonase',
        'tanggal_panen'
    ];
}