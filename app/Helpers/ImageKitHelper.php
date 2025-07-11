<?php

namespace App\Helpers;

use ImageKit\ImageKit;

class ImageKitHelper
{
    public static function uploadImage($file, $folder = 'default')
    {
        if (!$file) {
            return null;
        }

        $imageKit = new ImageKit(
            publicKey: env('IMAGEKIT_PUBLIC_KEY'),
            privateKey: env('IMAGEKIT_PRIVATE_KEY'),
            urlEndpoint: env('IMAGEKIT_URL_ENDPOINT')
        );

        $fileData = [
            'file' => base64_encode(file_get_contents($file->getRealPath())),
            'fileName' => uniqid() . '.' . $file->getClientOriginalExtension(),
            'folder' => $folder,
        ];

        $upload = $imageKit->upload($fileData);

        if (isset($upload->result->url) && isset($upload->result->fileId)) {
            return [
                'url' => $upload->result->url,
                'fileId' => $upload->result->fileId,
            ];
        }

        \Log::error('ImageKit upload failed: ' . json_encode($upload->error ?? 'Unknown error'));
        return null;
    }

    public static function deleteImage($fileId)
    {
        if (!$fileId) {
            return;
        }

        $imageKit = new ImageKit(
            publicKey: env('IMAGEKIT_PUBLIC_KEY'),
            privateKey: env('IMAGEKIT_PRIVATE_KEY'),
            urlEndpoint: env('IMAGEKIT_URL_ENDPOINT')
        );

        $result = $imageKit->deleteFile($fileId);
        if (isset($result->error)) {
            \Log::error('ImageKit deletion failed for fileId ' . $fileId . ': ' . json_encode($result->error));
        }
    }
}