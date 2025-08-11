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
         Schema::create('distribusi_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->string('bidang_tujuan');
            $table->text('catatan_sekretaris')->nullable();
            $table->timestamps();

            $table->foreign('surat_id')
                  ->references('id')
                  ->on('surat_masuks')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_surats');
    }
};
