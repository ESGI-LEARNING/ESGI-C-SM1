<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends AbstractController
{
    public function index(string $path): void
    {
        $requestParams = $_GET;
        $key           = config('glide.key');

        // SignatureFactory::create($key)->validateRequest($path, $requestParams);

        $server = ServerFactory::create([
            'source'            => 'media/',
            'cache'             => 'cache/',
            'driver'            => 'imagick',
            'cache_path_prefix' => '.cache',
            'base_url'          => '/images',
        ]);

        $server->outputImage($path, $requestParams);
    }
}
