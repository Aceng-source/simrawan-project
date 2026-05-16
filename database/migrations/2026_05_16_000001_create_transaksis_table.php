<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan', 20)->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('stok_ikan_id')->constrained('stok_ikans')->onDelete('cascade');
            $table->string('ukuran')->nullable();
            $table->decimal('jumlah', 10, 2); // dalam Kg
            $table->integer('total_harga');
            $table->text('alamat_pengiriman')->nullable();
            $table->enum('bukti_bayar', ['Belum Upload', 'Sudah Upload'])->default('Belum Upload');
            $table->date('tgl_upload')->nullable();
            $table->enum('status', [
                'Menunggu Pembayaran',
                'Menunggu Konfirmasi',
                'Diproses',
                'Dikirim',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu Pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
