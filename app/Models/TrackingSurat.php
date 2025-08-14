<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingSurat extends Model
{
    protected $table = 'tracking_surat';
    protected $fillable = ['surat_id', 'role', 'status', 'keterangan'];

    public function surat()
    {
        return $this->belongsTo(SuratMasuk::class);
    }
}
