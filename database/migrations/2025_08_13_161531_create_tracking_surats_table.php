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
        Schema::create('tracking_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->string('nama_role'); // admin, kaban, sekretaris, bidang_x
            $table->enum('status', ['selesai', 'menunggu'])->default('menunggu');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat_masuk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_surats');
    }
};
