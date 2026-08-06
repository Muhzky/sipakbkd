@php
    $title = 'Notifikasi';
    $breadcrumbs = ['Notifikasi' => '#'];
@endphp

@extends('layouts.main')

@section('content')
<div class="section-header">
    <h1>Notifikasi</h1>
    <div class="section-header-breadcrumb">
        @foreach($breadcrumbs as $label => $link)
            <span class="mx-1">/</span> <a href="{{ $link }}">{{ $label }}</a>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Semua Notifikasi</span>
                @if(Auth::user()->unreadNotifications->count() > 0)
                    <form action="{{ route('notifications.read-all') }}" method="POST" class="m-0">
                        @csrf @method('PUT')
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-check-double me-1"></i>Tandai semua dibaca
                        </button>
                    </form>
                @endif
            </div>
            <div class="card-body">
                @forelse($notifications as $notification)
                    <div class="d-flex align-items-start gap-3 pb-3 mb-3 {{ $notification->read_at ? '' : 'bg-light p-3 rounded' }}" style="border-bottom: 1px solid var(--border);">
                        <div class="mt-1">
                            @if(\Illuminate\Support\Str::contains($notification->type, 'PengajuanBaru'))
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #e8f4fd;">
                                    <i class="fas fa-file-alt" style="color: var(--info);"></i>
                                </div>
                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'PengajuanTerverifikasi'))
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #eaf7ef;">
                                    <i class="fas fa-check-circle" style="color: #3498db;"></i>
                                </div>
                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'PengajuanDiverifikasi'))
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #e8f4fd;">
                                    <i class="fas fa-check-double" style="color: #3498db;"></i>
                                </div>
                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'PengajuanDitolakOperator'))
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #fef3e2;">
                                    <i class="fas fa-undo" style="color: #f39c12;"></i>
                                </div>
                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'StatusPersetujuan'))
                                @if(($notification->data['status'] ?? '') === 'disetujui')
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #eaf7ef;">
                                        <i class="fas fa-check-circle" style="color: var(--primary);"></i>
                                    </div>
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #fdecec;">
                                        <i class="fas fa-times-circle" style="color: var(--danger);"></i>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div style="font-size: 14px; font-weight: {{ $notification->read_at ? '400' : '600' }}; color: var(--text);">
                                {{ $notification->data['message'] ?? '' }}
                            </div>
                            <div style="font-size: 12px; color: var(--muted); margin-top: 4px;">
                                {{ $notification->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('notifications.redirect', $notification) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px; font-size: 12px;">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.read', $notification) }}" method="POST" class="m-0">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px; font-size: 12px;">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" style="color: var(--muted);">
                        <i class="fas fa-bell-slash mb-3" style="font-size: 48px; display: block;"></i>
                        <p style="font-size: 16px;">Belum ada notifikasi</p>
                    </div>
                @endforelse

                @if($notifications->hasPages())
                    <div class="mt-3">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
