<?php

namespace App\Service;

use App\Models\Image;
use App\Models\User;
use Core\FileStorage\Storage;

class UploadFile
{
    public static function uploadImageArticles(array $files, int $article_id): void
    {
        $paths = Storage::upload($files, '/media');

        foreach ($paths as $path) {
            $i = new Image();
            $i->setImage($path);
            $i->setPictureId($article_id);
            $i->save();
        }
    }

    public static function uploadImageProfile(array $files, string $userId): void
    {
        $paths = Storage::upload($files, '/media');
        foreach ($paths as $path) {
            $user = new User();
            $user->setId($userId);
            $user->setAvatar($path);
            $user->save();
        }
    }
}
