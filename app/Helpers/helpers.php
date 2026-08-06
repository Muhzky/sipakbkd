<?php

use App\Services\SupabaseStorage;

if (!function_exists('supabase_storage_url')) {
    function supabase_storage_url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $storage = new SupabaseStorage();
        return $storage->getPublicUrl($path);
    }
}
