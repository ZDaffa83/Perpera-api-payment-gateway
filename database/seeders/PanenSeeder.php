<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = ['Rumput Gajah', 'Rumput Raja', 'Rumput Pakchong', 'Rumput Odot'];
        foreach ($jenis as $item) {
            \App\Models\Panen::create([
                'jenis_rumput' => $item,
                'tonase' => rand(10, 50),
                'tanggal_panen' => now()->format('Y-m-d'),
            ]);
        }
    }
}
