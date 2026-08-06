<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanDiverifikasi extends Notification
{
    use Queueable;

    public function __construct(
        public Pengajuan $pengajuan
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'pengajuan_id' => $this->pengajuan->id,
            'nomor_pengajuan' => $this->pengajuan->nomor_pengajuan,
            'status' => 'terverifikasi',
            'message' => 'Pengajuan ' . $this->pengajuan->nomor_pengajuan . ' telah diverifikasi operator dan diteruskan ke pimpinan untuk persetujuan.',
        ];
    }
}
