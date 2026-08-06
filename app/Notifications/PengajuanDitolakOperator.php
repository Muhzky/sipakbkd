<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanDitolakOperator extends Notification
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
            'status' => 'ditolak_operator',
            'alasan_penolakan' => $this->pengajuan->alasan_penolakan,
            'message' => 'Pengajuan ' . $this->pengajuan->nomor_pengajuan . ' ditolak oleh operator. ' . ($this->pengajuan->alasan_penolakan ? 'Alasan: ' . $this->pengajuan->alasan_penolakan : 'Silakan perbaiki dokumen pengajuan Anda.'),
        ];
    }
}
