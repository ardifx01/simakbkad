<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
   use HasFactory;

    protected $table = 'arsip_surat'; // nama tabel arsip
    protected $fillable = [
        'surat_id',       // foreign key ke surat_masuks
        'keterangan',
        'tanggal_arsip'
    ];

    public function surat()
    {
        // Relasi ke SuratMasuk
        return $this->belongsTo(SuratMasuk::class, 'surat_id', 'id');
    }
}
