<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('disposisis', function (Blueprint $table) {
            $table->text('kepada_bidang')->change(); // Ubah ke text
        });
    }

    public function down(): void
    {
        Schema::table('disposisis', function (Blueprint $table) {
            $table->unsignedBigInteger('kepada_bidang')->change(); // Rollback ke bigint kalau diperlukan
        });
    }
};
