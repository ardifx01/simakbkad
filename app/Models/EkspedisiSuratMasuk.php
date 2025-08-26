<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkspedisiSuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'ekspedisi_surat_masuks';

    protected $fillable = [
        'no',
        'sipengirim',
        'sipenerima',
        'nomor_surat',
        'perihal',
        'tanggal',
    ];

    protected $dates = [
        'tanggal',
    ];
}
