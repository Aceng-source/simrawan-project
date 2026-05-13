<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stok_ikans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ikan');
            $table->string('ukuran_sortasi');
            $table->decimal('jumlah_stok', 10, 2); // dalam Kg
            $table->decimal('harga_modal', 15, 2);
            $table->decimal('harga_jual', 15, 2);
            $table->enum('status', ['Tersedia', 'Habis'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_ikans');
    }
};
