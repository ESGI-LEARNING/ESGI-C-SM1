<?php

namespace Core\FileStorage;

class Storage
{
    private const DOWNLOAD_PATH = '/var/www/public';

    public static function update(string $file, string $path, string $oldFile): void
    {
        self::delete($oldFile, $path);
        self::upload($file, $path);
    }

    public static function delete(string $path): void
    {
        unlink(self::DOWNLOAD_PATH.'/media/'.$path);
    }

    public static function upload(array &$files, string $path): array
    {
        $paths = [];

        if (isset($files['name']) && is_array($files['name'])) {
            $fileCount = count($files['name']);
            for ($i = 0; $i < $fileCount; ++$i) {
                $name = self::getName($files['name'][$i]);
                $tmp  = $files['tmp_name'][$i];

                if (!is_dir(self::DOWNLOAD_PATH.$path)) {
                    (new Storage())->make($path);
                }

                $uploadFile = self::DOWNLOAD_PATH.$path.'/'.$name;

                move_uploaded_file($tmp, $uploadFile);

                $paths[] = $name;
            }
        } else {
            $name = self::getName($files['name']);
            $tmp  = $files['tmp_name'];

            if (!is_dir(self::DOWNLOAD_PATH.$path)) {
                (new Storage())->make($path);
            }

            $uploadFile = self::DOWNLOAD_PATH.$path.'/'.$name;

            move_uploaded_file($tmp, $uploadFile);

            $paths[] = $name;
        }

        return $paths;
    }

    private static function getName(string $name): string
    {
        $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $name = preg_replace('/[^A-Za-z0-9.]/', '', $name);

        return basename(uniqid().'_'.strtolower($name));
    }

    public function make(string $path): void
    {
        mkdir(self::DOWNLOAD_PATH.$path);
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
