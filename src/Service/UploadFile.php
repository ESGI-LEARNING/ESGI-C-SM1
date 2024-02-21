<?php

namespace App\Service;

use App\Models\Image;
use App\Models\User;
use Core\Auth\Auth;
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
            $i->setCreatedAt();
            $i->setUpdatedAt();
            $i->save();
        }
    }

    public static function uploadImageProfile(array $files, string $userId): void
    {
        $paths = Storage::upload($files, '/media');
        foreach ($paths as $path) {
            $user = User::query()->getOneBy(['id' => $userId]);

            if ($user->getAvatar() !== null) {
                Storage::delete($user->getAvatar());
            }

            $user->setAvatar($path);
            $user->setUpdatedAt();
            $user->save();
        }
    }
}
