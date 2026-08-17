<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('supabase_storage_url')) {
    function supabase_storage_url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (!Storage::disk('public')->exists($path)) {
            return null;
        }

        return Storage::disk('public')->url($path);
    }
}
