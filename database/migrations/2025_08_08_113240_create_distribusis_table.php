<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('distribusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_masuk_id')
                ->constrained(table: 'surat_masuks') // <- disesuaikan
                ->onDelete('cascade');
            $table->foreignId('kabid_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sekretaris_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('Terkirim');
            $table->text('catatan')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusis');
    }
};
