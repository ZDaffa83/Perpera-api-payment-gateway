<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatTanam;

class RiwayatTanamSeeder extends Seeder
{
    public function run(): void
    {
        RiwayatTanam::create([
            'tanggal' => '2024-07-03',
            'kegiatan_perawatan' => 'Rumput Gajah',
            'catatan' => 'Informasi tambahan dan Volume',
            'status' => true,
        ]);

        RiwayatTanam::create([
            'tanggal' => '2024-07-10',
            'kegiatan_perawatan' => 'Pemupukan Urea',
            'catatan' => 'Pupuk 5kg per lahan',
            'status' => false,
        ]);
    }
}
