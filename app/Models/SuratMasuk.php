<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratMasuk extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai dengan nama model
    protected $table = 'surat_masuks';

    protected $fillable = [
        'jenis_surat',
        'no_surat',
        'tanggal_surat',
        'tanggal_masuk',
        'asal_surat',
        'perihal',
        'file_surat',
        'no_agenda',
        'sifat',
        'created_by',
        'status_disposisi',
        'status_kabid',
        'tanggal_selesai',
        'status_sekretaris',
    ];



    // Relasi ke user yang membuat surat
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke disposisi (satu surat hanya punya satu disposisi)
    public function disposisi()
    {
        // return $this->hasOne(Disposisi::class, 'surat_id');
        return $this->hasMany(Disposisi::class, 'surat_id');
    }
    // Relasi ke Distribusi
    public function distribusi()
    {
        return $this->hasMany(DistribusiSurat::class, 'surat_id');
    }
    public function arsip() {}
}
