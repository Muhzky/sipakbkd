<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPersetujuan extends Notification
{
    use Queueable;

    public function __construct(
        public Pengajuan $pengajuan,
        public string $status,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $isApproved = $this->status === 'disetujui';
        return [
            'pengajuan_id' => $this->pengajuan->id,
            'nomor_pengajuan' => $this->pengajuan->nomor_pengajuan,
            'status' => $this->status,
            'alasan_penolakan' => $this->pengajuan->alasan_penolakan,
            'message' => $isApproved
                ? 'Pengajuan ' . $this->pengajuan->nomor_pengajuan . ' telah DISETUJUI. SK dapat diunduh.'
                : 'Pengajuan ' . $this->pengajuan->nomor_pengajuan . ' telah DITOLAK.',
        ];
    }
}
