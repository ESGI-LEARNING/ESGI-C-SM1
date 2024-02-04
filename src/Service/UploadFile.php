<?php

namespace App\Service;

use App\Models\Image;
use Core\FileStorage\Storage;

class UploadFile
{
    public static function uploadImageArticles(array $files, string $article_id): void
    {
        $paths = Storage::upload($files, '/media');

        foreach ($paths as $path) {
            $i = new Image();
            $i->setImage($path);
            $i->setPictureId($article_id);
            $i->save();
        }
    }
}
