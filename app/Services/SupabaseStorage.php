<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class SupabaseStorage
{
    private string $baseUrl;
    private string $apiKey;
    private string $bucket;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.supabase.url', ''), '/');
        $this->apiKey = config('services.supabase.service_role_key', config('services.supabase.key', ''));
        $this->bucket = config('services.supabase.storage_bucket', 'avatars');
    }

    public function upload(string $path, UploadedFile $file): string
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->attach(
            'file', file_get_contents($file), $file->getClientOriginalName(), ['Content-Type' => $file->getMimeType()]
        )->post("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$path}");

        if ($response->failed()) {
            throw new \RuntimeException('Gagal upload ke Supabase Storage: ' . $response->body());
        }

        return $path;
    }

    public function delete(string $path): bool
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->delete("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$path}");

        return $response->successful();
    }

    public function getPublicUrl(string $path): string
    {
        return "{$this->baseUrl}/storage/v1/object/public/{$this->bucket}/{$path}";
    }

    public function exists(string $path): bool
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->head("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$path}");

        return $response->successful();
    }

    public function download(string $path): ?string
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$path}");

        if ($response->failed()) {
            return null;
        }

        return $response->body();
    }

    public function getTemporarySignedUrl(string $path, int $expiresIn = 3600): string
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post("{$this->baseUrl}/storage/v1/object/sign/{$this->bucket}/{$path}", [
            'expiresIn' => $expiresIn,
        ]);

        if ($response->failed()) {
            throw new \RuntimeException('Gagal generate signed URL: ' . $response->body());
        }

        $signedToken = $response->json('signedUrl');
        return "{$this->baseUrl}/storage/v1/{$signedToken}";
    }
}
