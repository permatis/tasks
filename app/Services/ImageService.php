<?php

namespace App\Services;

use Intervention\Image\ImageManager;

class ImageService
{
    private $image;

    public function __construct(ImageManager $image)
    {
        $this->image = $image;
    }

    public function saveImgToDirectory($file, $files)
    {
        return $this->image->make($file)
            ->encode('jpg')->resize(50, 50)
            ->save(public_path('img/tasks').'/'.$files);
    }

    public function getCoolFilename($filename)
    {
        return $this->sanitizeFilename(
            preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename)
        );
    }

    protected function sanitizeFilename($file)
    {
        return ucwords(
            str_replace('-', ' ',
                mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file)
            ));
    }

    public function uniqueFilename()
    {
        return substr(sha1(mt_rand()), 0, 10);
    }
}
