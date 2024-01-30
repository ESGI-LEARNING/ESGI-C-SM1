<?php

namespace Core\FileStorage;

class Storage
{
    private const DOWNLOAD_PATH = "/var/www/storage/";

    public static function upload(array $file, string $path): string
    {
        $name = basename(uniqid() . '-' . str_replace(' ', '-', $file['name']));
        $tmp = $file['tmp_name'];

        if (!is_dir(self::DOWNLOAD_PATH . $path)) {
            (new Storage)->make($path);
        }

        $uploadFile = self::DOWNLOAD_PATH . $path . '/' . $name;

        move_uploaded_file($tmp, $uploadFile);

        return $path . '/' . $name;
    }

    public function make(string $path): void
    {
        mkdir(self::DOWNLOAD_PATH . $path);
    }

    public static function delete(string $file, string $path): void
    {
        $file = $_FILES[$file];

        $name = $file['name'];
        $tmp  = $file['tmp_name'];

        unlink($path . $name);
    }

    public static function update(string $file, string $path, string $oldFile): void
    {
        self::delete($oldFile, $path);
        self::upload($file, $path);
    }

    public static function getExtension(string $file): string
    {
        $file = $_FILES[$file];

        $name = $file['name'];

        return pathinfo($name, PATHINFO_EXTENSION);
    }

    public static function getFileName(string $file): string
    {
        $file = $_FILES[$file];

        $name = $file['name'];

        return pathinfo($name, PATHINFO_FILENAME);
    }

    public static function getFilePath(string $file): string
    {
        $file = $_FILES[$file];

        $name = $file['name'];

        return pathinfo($name, PATHINFO_DIRNAME);
    }
}
