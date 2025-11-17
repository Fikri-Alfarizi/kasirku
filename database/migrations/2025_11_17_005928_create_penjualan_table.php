<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penjualan')->default(now());
            $table->unsignedBigInteger('id_pelanggan')->nullable();

            $table->integer('total_harga');
            $table->integer('total_diskon')->default(0);
            $table->integer('grand_total');

            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('pelanggan')
                ->onDelete('set null');
        });
    }
};
