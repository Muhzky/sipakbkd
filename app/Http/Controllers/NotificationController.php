<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return back()->with('success', 'Notifikasi telah ditandai sudah dibaca.');
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai sudah dibaca.');
    }

    public function redirect(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        $data = $notification->data;

        if (Auth::user()->hasRole('Pimpinan')) {
            return redirect()->route('pimpinan.pengajuan.show', $data['pengajuan_id']);
        }

        if (Auth::user()->hasRole('Admin BKD')) {
            return redirect()->route('admin.pengajuan.verifikasi', $data['pengajuan_id']);
        }

        if (Auth::user()->hasRole('Pegawai')) {
            return redirect()->route('pegawai.pengajuan.show', $data['pengajuan_id']);
        }

        return redirect()->route('dashboard');
    }
}
