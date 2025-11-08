<?php

namespace App\Utils;

use Exception;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CloudStorageUtils
{
    public static function uploadFile(UploadedFile $file, $folder = null)
    {
        try {
            $name = Str::random(32); // Generate a random file name
            $fileName = $name . '.' . $file->getClientOriginalExtension();

            // Upload to GCS
            return $file->storeAs(
                $folder,
                $fileName,
                'gcs'
            );
        } catch (Exception $e) {
            Log::error("Upload file to GCS failed: " . $e->getMessage(), [
                'folder' => $folder,
                'file_name' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    public static function uploadSecure(UploadedFile $file, $folder = null)
    {
        try {
            $name = Str::random(32);
            $fileName = $name . '.' . $file->getClientOriginalExtension();

            // upload to GCS with visibility private
            Storage::disk('gcs')->putFileAs(
                $folder,
                $file,
                $fileName,
                ['visibility' => 'private']
            );

            return "{$folder}/{$fileName}";
        } catch (Exception $e) {
            Log::error("Upload secure file to GCS failed: " . $e->getMessage(), [
                'folder' => $folder,
                'file_name' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    // public static function uploadSecure(UploadedFile $file, $folder = null)
    // {
    //     try {
    //         $name = Str::random(32);
    //         $fileName = $name . '.' . $file->getClientOriginalExtension();

    //         // read file content
    //         $content = file_get_contents($file->getRealPath());

    //         // encrypt the content
    //         $encryptedContent = encrypt($content); // Laravel's encrypt() = AES-256-CBC + base64

    //         // upload encrypted string to GCS
    //         Storage::disk('gcs')->put("{$folder}/{$fileName}", $encryptedContent, 'private');

    //         return "{$folder}/{$fileName}";
    //     } catch (Exception $e) {
    //         Log::error("Upload secure file to GCS failed: " . $e->getMessage(), [
    //             'folder' => $folder,
    //             'file_name' => $file->getClientOriginalName(),
    //             'trace' => $e->getTraceAsString()
    //         ]);
    //         return null;
    //     }
    // }

    public static function getFilePath($path)
    {
        try {
            if ($path !== null) {
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    return $path;
                }

                $bucket = env('GOOGLE_CLOUD_STORAGE_BUCKET', 'medicare-storage');
                return "https://storage.googleapis.com/{$bucket}/{$path}";
            }
            return null;
        } catch (Exception $e) {
            Log::error("Failed to generate GCS file URL: " . $e->getMessage(), [
                'path' => $path,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    public static function getSecureSignedUrl($path, $expireMinutes = 10)
    {
        try {
            if (!$path)
                return null;

            $storage = new StorageClient([
                'keyFilePath' => storage_path('app/firebase-auth.json'),
            ]);

            $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));
            $object = $bucket->object($path);

            return $object->signedUrl(now()->addMinutes($expireMinutes));
        } catch (Exception $e) {
            Log::error("Failed to generate signed URL", [
                'path' => $path,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    public static function deleteFile($path = null)
    {
        try {
            if ($path !== null) {
                Storage::disk('gcs')->delete($path);
            }
        } catch (Exception $e) {
            Log::error("Failed to delete file from GCS: " . $e->getMessage(), [
                'path' => $path,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
