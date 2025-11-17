<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_penjualan');
            $table->unsignedBigInteger('id_produk');

            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->integer('subtotal');

            $table->timestamps();

            $table->foreign('id_penjualan')
                ->references('id')
                ->on('penjualan')
                ->onDelete('cascade');

            $table->foreign('id_produk')
                ->references('id')
                ->on('produk')
                ->onDelete('cascade');
        });
    }
};
