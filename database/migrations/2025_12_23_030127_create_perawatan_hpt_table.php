<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('perawatan_hpt', function (Blueprint $table) {
            $table->id('id_perawatan');
            $table->date('tanggal')->nullable();
            $table->string('kegiatan')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('perawatan_hpt');
    }
};