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
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_surat');
            $table->string('no_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_masuk');
            $table->string('no_agenda')->nullable();
            $table->string('asal_surat');
            $table->text('perihal');
            $table->string('sifat')->nullable();
            $table->string('file_surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surats');
    }
};
