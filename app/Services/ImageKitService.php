<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }

    /**
     * Upload file to ImageKit with folder support
     */
    public function uploadToFolder($filePath, $fileName, $folder = '/uploads')
    {
        $payload = [
            'file' => base64_encode(file_get_contents($filePath)),
            'fileName' => $fileName,
            'folder' => $folder
        ];

        return $this->imageKit->upload($payload);
    }

    /**
     * Delete file from ImageKit using fileId
     */
    public function deleteFile($fileId)
    {
        if (!$fileId) {
            return false;
        }

        return $this->imageKit->deleteFile($fileId);
    }
}
