<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    public function surat()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_id');
    }
    public function dari()
    {
        return $this->belongsTo(User::class, 'dari_id');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'kepada_bidang');
    }
    protected $fillable = [
        'surat_id',
        'dari_id',
        'kepada_bidang',
        'isi_disposisi',
        'tanggal',
        'tindakan',
    ];
}
