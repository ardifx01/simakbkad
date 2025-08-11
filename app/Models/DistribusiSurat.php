<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiSurat extends Model
{
    protected $table = 'distribusi_surats'; // ganti sesuai nama tabel di DB
    protected $fillable = [
        'surat_id',
        'bidang_tujuan',
        'catatan_sekretaris'
    ];

    // Relasi ke SuratMasuk
    public function surat()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_id');
    }
}
