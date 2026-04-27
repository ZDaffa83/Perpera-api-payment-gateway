<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_bibits', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('nama_pembeli');
            $table->string('jenis_bibit');
            $table->integer('jumlah');
            $table->bigInteger('total_harga');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('snap_token')->nullable(); //  Token Midtrans
            $table->timestamps();
        });
    }
};
