<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('inventaris_bibits', function (Blueprint $table) {
        $table->id();
        $table->string('nama_bibit');
        $table->integer('stok_tersedia');
        $table->string('lokasi_gudang')->nullable();
        $table->timestamps();
    });
}
};
