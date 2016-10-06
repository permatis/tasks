<?php

namespace App\Repository;

use App\Models\Image;
use App\Services\ImageService;

class ImageRepository
{
    private $image;
    private $images;

    public function __construct(Image $image,
                                ImageService $images)
    {
        $this->image = $image;
        $this->images = $images;
    }

    public function save($request)
    {
        $file = $request->file('images');
        $filename = $this->images->getCoolFilename(
            $file->getClientOriginalName()
        );

        $files = $this->images->uniqueFilename().'.jpg';
        $this->images->saveImgToDirectory(
            $file->getRealPath(), $files
        );

        $images = $this->image->create([
            'filename' => $filename,
            'file'     => $files,
        ]);

        return $images;
    }
}
