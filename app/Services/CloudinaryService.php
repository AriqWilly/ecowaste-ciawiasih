<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CloudinaryService
{
    /**
     * Upload an image file or file path to Cloudinary.
     *
     * @param mixed $file UploadedFile instance or file path string
     * @param string $folder Subfolder name in Cloudinary
     * @return string|null The HTTPS secure URL of the uploaded image
     */
    public static function upload($file, string $folder = 'ecowaste'): ?string
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME', 'do23oguqc');
        $apiKey = env('CLOUDINARY_API_KEY', '449742647457763');
        $apiSecret = env('CLOUDINARY_API_SECRET', 'U7nFeXKBt0-hxuENco5mpxo-o3M');

        if (!$file) {
            return null;
        }

        $timestamp = time();
        $paramsToSign = "folder={$folder}&timestamp={$timestamp}";
        $signature = sha1($paramsToSign . $apiSecret);

        try {
            $response = Http::asMultipart()->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                [
                    'name' => 'file',
                    'contents' => is_string($file) ? fopen($file, 'r') : fopen($file->getRealPath(), 'r'),
                    'filename' => is_string($file) ? basename($file) : $file->getClientOriginalName(),
                ],
                [
                    'name' => 'api_key',
                    'contents' => $apiKey,
                ],
                [
                    'name' => 'timestamp',
                    'contents' => (string) $timestamp,
                ],
                [
                    'name' => 'signature',
                    'contents' => $signature,
                ],
                [
                    'name' => 'folder',
                    'contents' => $folder,
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['secure_url'] ?? null;
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Cloudinary Upload Exception: ' . $e->getMessage());
        }

        return null;
    }
}
