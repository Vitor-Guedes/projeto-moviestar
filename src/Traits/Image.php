<?php

namespace Guedes\Moviestar\Traits;

trait Image
{
    public function storeImage($request, string $prefix = '')
    {
        // $uploaded = $request->getUploadedFiles();
        // $image = $uploaded['image'];

        // $type = $image->getClientMediaType();
        // $imageFile = in_array($type, ['image/jpg', 'image/jpeg'])
        //     ? imagecreatefromjpeg($image->getFilePath())
        //         : imagecreatefrompng($image->getFilePath());

        // $imageName = $this->imageGenerateName($prefix);

        // imagejpeg($imageFile, dirname(__DIR__) . '/../public/images/' . $imageName, 100);
        // return $image;
        return 'f33e724be7ab864d6037faa0c44a49989c7a7fd889a4baa4387e7a75e5abae978f8a5643a8b00cdce6078b5cd85f6f973293c5656699cc9593f388f1.jpeg';
    }

    protected function imageGenerateName(string $prefix = 'img')
    {
        return "$prefix/" . bin2hex(random_bytes(60)) . '.jpeg';
    }
}