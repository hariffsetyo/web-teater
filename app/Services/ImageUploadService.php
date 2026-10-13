<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageUploadService
{
    /**
     * Upload and resize image
     */
    public static function upload(UploadedFile $file, string $folder, ?int $width = 800, ?int $height = null): string
    {
        $targetDir = storage_path('app/public/' . $folder);
        if (!File::isDirectory($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $fullPath = $targetDir . '/' . $filename;

        try {
            $image = Image::read($file);
            if ($width && $height) {
                $image->cover($width, $height);
            } elseif ($width) {
                $image->scale(width: $width);
            }
            $image->save($fullPath);
        } catch (\Throwable $e) {
            // Fallback to standard move if image driver fails
            $file->move($targetDir, $filename);
        }

        return 'storage/' . $folder . '/' . $filename;
    }

    /**
     * Safely delete file from storage
     */
    public static function delete(?string $path): void
    {
        if (empty($path)) return;

        // Convert 'storage/xxx' to 'storage/app/public/xxx'
        if (str_starts_with($path, 'storage/')) {
            $relativePath = substr($path, 8);
            $fullPath = storage_path('app/public/' . $relativePath);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }
    }
}