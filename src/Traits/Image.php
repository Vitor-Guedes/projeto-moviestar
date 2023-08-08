<?php

namespace Guedes\Moviestar\Traits;

trait Image
{
    public function storeImage($request, string $prefix = '')
    {
        $uploaded = $request->getUploadedFiles();
        $image = $uploaded['image'];

        $type = $image->getClientMediaType();
        $imageFile = in_array($type, ['image/jpg', 'image/jpeg'])
            ? imagecreatefromjpeg($image->getFilePath())
                : imagecreatefrompng($image->getFilePath());

        $imageName = $this->imageGenerateName($prefix);

        imagejpeg($imageFile, dirname(__DIR__) . '/../public/images/' . $imageName, 100);
        return $imageName;
    }

    protected function imageGenerateName(string $prefix = 'img')
    {
        return "$prefix/" . bin2hex(random_bytes(60)) . '.jpeg';
    }
}