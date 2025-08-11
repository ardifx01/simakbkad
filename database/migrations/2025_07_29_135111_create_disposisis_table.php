<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat_masuks')->onDelete('cascade');
            $table->foreignId('dari_id')->constrained('users')->onDelete('cascade');
            $table->text('kepada_bidang'); // Menggunakan text untuk menyimpan array bidang (hasil implode)
            $table->text('isi_disposisi');
            $table->date('tanggal');
            $table->text('tindakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
