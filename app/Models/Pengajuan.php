<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengajuan extends Model
{
    protected $fillable = [
        'pegawai_id',
        'nomor_pengajuan',
        'tanggal',
        'pangkat_lama',
        'pangkat_baru',
        'jenis_kenaikan',
        'keterangan',
        'status',
        'alasan_penolakan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function dokumen(): HasOne
    {
        return $this->hasOne(Dokumen::class);
    }
}
