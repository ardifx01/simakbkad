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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->foreignId('surat_masuk_id')->nullable()->constrained('surat_masuks');
            $table->date('tanggal_keluar');
            $table->string('kepada');
            $table->text('isi_surat');
            $table->string('file_surat');
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->enum('status_ttd', ['Menunggu', 'Sudah TTD']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
