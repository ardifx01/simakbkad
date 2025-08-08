<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;

    protected $table = 'distribusi'; // sesuaikan dengan nama tabel di database

    protected $fillable = [
        'surat_id',       // relasi ke tabel surat masuk
        'user_id',        // user penerima (kabid terkait)
        'catatan',        // catatan disposisi
        'status',         // status distribusi (misalnya: "Terkirim", "Selesai")
        'tanggal_kirim',  // tanggal distribusi
    ];

    /**
     * Relasi ke Surat
     */
    public function surat()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_id');
    }

    /**
     * Relasi ke User penerima
     */
    public function penerima()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
