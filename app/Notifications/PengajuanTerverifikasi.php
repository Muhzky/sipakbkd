<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanTerverifikasi extends Notification
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
            'pegawai_nama' => $this->pengajuan->pegawai->user->nama,
            'pangkat_lama' => $this->pengajuan->pangkat_lama,
            'pangkat_baru' => $this->pengajuan->pangkat_baru,
            'message' => 'Pengajuan ' . $this->pengajuan->nomor_pengajuan . ' dari ' . $this->pengajuan->pegawai->user->nama . ' telah diverifikasi dan menunggu persetujuan.',
        ];
    }
}
