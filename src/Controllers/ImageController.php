<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use League\Glide\ServerFactory;

class ImageController extends AbstractController
{
    public function index(string $path): void
    {
        $server = ServerFactory::create([
            'source'            => 'media/',
            'cache'             => 'cache/',
            'driver'            => 'imagick',
            'cache_path_prefix' => '.cache',
            'base_url'          => '/images',
        ]);

        $server->outputImage($path,  $this->request()->all());
    }
}
